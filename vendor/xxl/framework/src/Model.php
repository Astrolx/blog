<?php

namespace vendor;

class Model
{
	protected $host;
	protected $user;
	protected $pwd;
	protected $dbname;
	protected $charset;
	protected $prefix;
	
	protected $table;
	
	protected $link;
	protected $fields = [];  //存放缓存的字段
	protected $sql;
	
	//这个数组中存放的是你传递过来的有关sql语句的所有的参数
	protected $options = [];
	
	function __get($name)
	{
		if ($name == 'sql') {
			return $this->sql;
		}
		return false;
	}
	
	function __construct($config = null)
	{
		
		$config = $GLOBALS['config'];
		$this->host = $config['DB_HOST'];
		$this->user = $config['DB_USER'];
		$this->pwd = $config['DB_PWD'];
		$this->dbname = $config['DB_NAME'];
		$this->charset = $config['DB_CHARSET'];
		$this->prefix = $config['DB_PREFIX'];
		
		//连接数据库
		$this->link = $this->connect();
		//得到表名
		$this->table = $this->getTableName();
		
		//缓存这个表中所有的字段
		$this->fields = $this->cacheFields();
		//初始化参数数组
		$this->initOptions();
	}
	
	protected function connect()
	{
		$link = mysqli_connect($this->host, $this->user, $this->pwd);
		if (!$link) {
			die('数据库连接失败');
		}
		mysqli_select_db($link, $this->dbname);
		mysqli_set_charset($link, $this->charset);
		return $link;
	}
	
	protected function getTableName()
	{
		//如果设置了表名，那么以设置的为准，如果没有设置表名，那么默认从类名中来获取
		if (empty($this->table)) {
			//得到当前类名，然后从类名中的到表名  UserModel
			//echo get_class($this);
			$name = get_class($this);
			$arr = explode('\\', $name);
			$name = array_pop($arr);
			$name = strtolower(substr($name, 0, -5));
			//echo $name;
			return $this->prefix . $name;
		} else {
			return $this->prefix . $this->table;
		}
	}
	
	protected function cacheFields()
	{
		$fileName = './public/' . $this->table . '.php';
		if (file_exists($fileName)) {
			$fields = include $fileName;
			return $fields;
		}
		//得到所有的字段   
		$sql = 'desc ' . $this->table;
		$result = $this->query($sql);
		//遍历得到所有的字段名。保存到数组中
		foreach ($result as $value) {
			$fields[] = $value['Field'];
			if ($value['Key'] == 'PRI') {
				$fields['PRI'] = $value['Field'];
			}
		}
		//var_dump($fields);
		//将缓存字段写入到文件中
		$str = var_export($fields, true);
		$str = "<?php \n return " . $str . ';';
		file_put_contents($fileName, $str);
		return $fields;
	}
	
	protected function initOptions()
	{
		$arr = ['field', 'table', 'where', 'limit', 'order', 'group', 'having'];
		//将数组中的这些键对应的值设置为空
		foreach ($arr as $value) {
			$this->options[$value] = '';
		}
		$this->options['field'] = join(',', array_unique($this->fields));
		$this->options['table'] = $this->table;
		//var_dump($this->options);
	}
	
	function query($sql)
	{
		//保存sql语句
		$this->sql = $sql;
		
		$result = mysqli_query($this->link, $sql);
		$newData = [];
		if ($result && mysqli_affected_rows($this->link)) {
			while ($data = mysqli_fetch_assoc($result)) {
				$newData[] = $data;
			}
		}
		//清空所有的参数
		$this->initOptions();
		return $newData;
	}
	
	// name,age   ['name', 'age']
	function field($field)
	{
		if (!empty($field)) {
			if (is_array($field)) {
				$this->options['field'] = join(',', $field);
			} else if (is_string($field)) {
				$this->options['field'] = $field;
			}
		}
		return $this;
	}
	
	function table($table)
	{
		$this->options['table'] = $table;
		return $this;
	}
	
	function where($where)
	{
		$this->options['where'] = ' where ' . $where;
		return $this;
	}
	
	function group($group)
	{
		$this->options['group'] = ' group by ' . $group;
		return $this;
	}
	
	function having($having)
	{
		$this->options['having'] = ' having ' . $having;
		return $this;
	}
	
	function order($order)
	{
		$this->options['order'] = ' order by ' . $order;
		return $this;
	}
	
	function limit($limit)
	{
		if (is_array($limit)) {
			$this->options['limit'] = ' limit ' . join(',', $limit);
		} else {
			$this->options['limit'] = ' limit ' . $limit;
		}
		return $this;
	}
	
	function select()
	{
		//准备sql语句
		$sql = 'select %field% from %table% %where% %group% %having% %order% %limit%';
		//将传递过来的参数依次的替换掉里面的内容
		$sql = str_replace(
			['%field%', '%table%', '%where%', '%group%', '%having%', '%order%', '%limit%'], 
			[$this->options['field'], $this->options['table'], $this->options['where'], $this->options['group'], $this->options['having'], $this->options['order'], $this->options['limit']], 
			$sql);
		//echo $sql . '<br />';
		$result = $this->query($sql);
		return $result;
	}
	
	function exec($sql, $isInsert = false)
	{
		$this->sql = $sql;
		$result = mysqli_query($this->link, $sql);
		if ($result && mysqli_affected_rows($this->link)) {
			if ($isInsert) {
				return mysqli_insert_id($this->link);
			} else {
				return mysqli_affected_rows($this->link);
			}
		}
		//清空所有的参数
		$this->initOptions();
		return false;
	}
	
	function insert($data)
	{	//var_dump($data);
		//处理数组中的值为字符串的给我添加单引号
		$data = $this->parseData($data);
		//过滤掉无效的字段
		$data = array_intersect_key($data, array_flip(array_unique($this->fields)));
		//var_dump($data);
		//die;
		//提取所有的键和值
		$keys = array_keys($data);
		$values = array_values($data);
		//准备sql语句
		$sql = 'insert into %table%(%field%) values(%values%)';
		$sql = str_replace(
			['%table%', '%field%', '%values%'], 
			[$this->options['table'], join(',', $keys), join(',', $values)], 
			$sql);
		//执行sql语句
		//echo $sql;
		return $this->exec($sql, true);
	}
	
	protected function parseData($data)
	{
		$newData = [];
		foreach ($data as $key => $value) {
			if (is_string($value)) {
				$value = '\'' . $value . '\'';
			}
			$newData[$key] = $value;
		}
		return $newData;
	}
	
	function update($data)
	{
		//先处理单引号问题
		$data = $this->parseData($data);
		//var_dump($data);die;
		//过滤字段
		$data = array_intersect_key($data, array_flip(array_unique($this->fields)));
		$updateString = $this->parseUpdate($data);
		//echo $updateString;
		$sql = 'update %table% set %field% %where%';
		$sql = str_replace(
			['%table%', '%field%', '%where%'], 
			[$this->options['table'], $updateString, $this->options['where']], 
			$sql);
		//清空所有的参数
		$this->initOptions();
		return $this->exec($sql);
	}
	
	protected function parseUpdate($data)
	{
		foreach ($data as $key => $value) {
			$arr[] = $key . '=' . $value;
		}
		return join(',', $arr);
	}
	
	function delete()
	{
		$sql = 'delete from %table% %where%';
		$sql = str_replace(['%table%', '%where%'], [$this->options['table'], $this->options['where']], $sql);
		//清空所有的参数
		$this->initOptions();
		return $this->exec($sql);
	}
	
	function max($field = null)
	{
		//如果没有传递明确的字段，那么我们使用主键为您服务
		if (empty($field)) {
			$field = $this->fields['PRI'];
		}
		$sql = 'select max(' . $field . ') as m from ' . $this->options['table'];
		$result = $this->query($sql);
		//var_dump($result);
		return $result[0]['m'];
	}
	//  min  avg  sum  count
	
	//getByName   getByEmail
	function __call($name, $args)
	{
		if (strstr($name, 'getBy')) {
			//取出字段名
			$field = strtolower(substr($name, 5));
			//取出字段值
			$value = $args[0];
			//var_dump($value);
			//$sql = 'select ';   自己拼接sql语句来实现也可以
			$result = $this->where($field . '="' . $value . '"')->select();
			return $result;
		}
		return false;
	}
	
	//自己写一个方法   根据主键去查找一个记录  一行数据
	function find($id)
	{
		
	}
	
	function __destruct()
	{
		mysqli_close($this->link);
	}
}
























