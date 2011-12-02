<?php
Wind::import('WIND:utlity.WindFile');
/**
 * 文件夹工具类
 *
 * @author Qiong Wu <papa0924@gmail.com> 2011-12-2
 * @copyright ©2003-2103 phpwind.com
 * @license http://www.windframework.com
 * @version $Id$
 * @package utility
 */
class WindFolder {

	/**
	 * 获取文件列表
	 * 
	 * @param string $dir
	 * @return array
	 */
	public static function read($dir) {
		if (!self::isDir($dir)) return array();
		if (!$handle = @opendir($dir)) return array();
		$files = array();
		while (false !== ($file = @readdir($handle))) {
			if ('.' === $file || '..' === $file) continue;
			if (!WindFile::isFile($dir . '/' . $file)) continue;
			$files[] = $file;
		}
		@closedir($handle);
		return $files;
	}

	/**
	 * 删除目录
	 * 
	 * @param string $dir
	 * @param boolean $f 是否强制删除
	 * @return boolean
	 */
	public static function rm($dir, $f = false) {
		return $f ? self::clearRecur($dir, true) : @rmdir($dir);
	}

	/**
	 * 删除指定目录下的文件
	 * 
	 * @param string  $dir 目录
	 * @param boolean $delFolder 是否删除目录
	 * @return boolean
	 */
	public static function clear($dir, $delFolder = false) {
		if (!self::isDir($dir)) return false;
		if (!$handle = @opendir($dir)) return false;
		while (false !== ($file = readdir($handle))) {
			if ('.' === $file[0] || '..' === $file[0]) continue;
			$filename = $dir . '/' . $file;
			if (WindFile::isFile($filename)) WindFile::del($filename);
		}
		$delFolder && @rmdir($dir);
		@closedir($handle);
		return true;
	}

	/**
	 * 递归的删除目录
	 * 
	 * @param string $dir 目录
	 * @param Boolean $delFolder 是否删除目录
	 */
	public static function clearRecur($dir, $delFolder = false) {
		if (!self::isDir($dir)) return false;
		if (!$handle = @opendir($dir)) return false;
		while (false !== ($file = readdir($handle))) {
			if ('.' === $file || '..' === $file) continue;
			$_path = $dir . '/' . $file;
			if (self::isDir($_path)) {
				self::clearRecur($_path, $delFolder);
			} elseif (WindFile::isFile($_path))
				WindFile::del($_path);
		}
		$delFolder && @rmdir($dir);
		@closedir($handle);
		return true;
	}

	/**
	 * 判断输入是否为目录
	 *
	 * @param string $dir
	 * @return boolean
	 */
	public static function isDir($dir) {
		return $dir ? is_dir($dir) : false;
	}

	/**
	 * 取得目录信息
	 * 
	 * @param string $dir 目录路径
	 * @return array
	 */
	public static function getInfo($dir) {
		return self::isDir($dir) ? stat($dir) : array();
	}

	/**
	 * 创建目录
	 *
	 * @param string $path 目录路径
	 * @param int $permissions 权限
	 * @return boolean
	 */
	public static function mk($path, $permissions = 0777) {
		return @mkdir($path, $permissions);
	}

	/**
	 * 递归的创建目录
	 *
	 * @param string $path 目录路径
	 * @param int $permissions 权限
	 * @return boolean
	 */
	public static function mkRecur($path, $permissions = 0777) {
		if (is_dir($path)) return true;
		$_path = dirname($path);
		if ($_path !== $path) self::mk($_path, $permissions);
		return self::mk($path, $permissions);
	}
}

?>