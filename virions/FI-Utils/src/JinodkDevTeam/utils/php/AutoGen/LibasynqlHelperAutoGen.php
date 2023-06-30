<?php
declare(strict_types=1);

namespace JinodkDevTeam\utils\php\AutoGen;

use pocketmine\plugin\PluginBase;
use poggit\libasynql\generic\GenericStatementFileParser;

class LibasynqlHelperAutoGen{

	/**
	 * @param PluginBase $plugin
	 * @param string     $path
	 * @param string     $resource
	 * @param string     $namespace
	 * @param bool       $removePrefix
	 *
	 * @return void
	 */
	public static function generateHelperFiles(PluginBase $plugin, string $path, string $resource, string $namespace = "",bool $removePrefix = false) : void{
		$sqlconst_dir = $path . "SqlStmtConstant.php";
		$sqlargs_dir = $path . "SqlStmtArgs.php";
		self::generateSqlConstFile($plugin, $sqlconst_dir, $resource, $namespace, $removePrefix);
		self::generateSqlArgsFile($plugin, $sqlargs_dir, $resource, $namespace, $removePrefix);
	}

	/**
	 * @param PluginBase $plugin
	 * @param string     $dir
	 * @param string     $resource
	 * @param string     $namespace
	 * @param bool       $removePrefix
	 *
	 * @return void
	 */
	private static function generateSqlConstFile(PluginBase $plugin, string $dir, string $resource, string $namespace = "", bool $removePrefix = false) : void{
		$parser = new GenericStatementFileParser(null, $plugin->getResource($resource));
		$parser->parse();
		$queries = $parser->getResults();
		ob_start();
		echo <<<'HEADER'
<?php
declare(strict_types=1);


HEADER;
echo "namespace " . $namespace . ";" . PHP_EOL;
echo <<<'HEADER'

class SqlStmtConstant{
	/**
	* This class is generated automatically, do NOT modify it by hand.
	* See JinodkDevTeam\utils\php\AutoGen\LibasynqlHelperAutoGen.php
	*/

HEADER;
		foreach($queries as $query){
			$query_name = str_replace(".", "_", strtoupper($query->getName()));
			if ($removePrefix){
				$query_name = substr($query_name, strpos($query_name, "_") + 1);
			}
			echo "\tpublic const " . $query_name . " = \"" . $query->getName() . "\";" . PHP_EOL;
		}
		echo "}" . PHP_EOL;
		$contents = ob_get_clean();
		file_put_contents($dir, $contents);
		echo "Done generating SqlStmtConstant.\n";
	}

	/**
	 * @param PluginBase $plugin
	 * @param string     $dir
	 * @param string     $resource
	 * @param string     $namespace
	 * @param bool       $removePrefix
	 *
	 * @return void
	 */
	private static function generateSqlArgsFile(PluginBase $plugin, string $dir,string $resource, string $namespace = "", bool $removePrefix = false) : void{
		$parser = new GenericStatementFileParser(null, $plugin->getResource($resource));
		$parser->parse();
		$queries = $parser->getResults();
		ob_start();
		echo <<<'HEADER'
<?php
declare(strict_types=1);


HEADER;
echo "namespace " . $namespace . ";" . PHP_EOL;
echo <<<'HEADER'

class SqlStmtArgs{
	/**
	* This class is generated automatically, do NOT modify it by hand.
	* See JinodkDevTeam\utils\php\AutoGen\LibasynqlHelperAutoGen.php
	*/

HEADER;
		foreach($queries as $query){
			if (count($query->getVariables()) === 0) {
				continue;
			}
			$query_name = str_replace(".", "_", strtolower($query->getName()));
			if ($removePrefix){
				$query_name = substr($query_name, strpos($query_name, "_") + 1);
			}
			echo "\tpublic static function " . $query_name . "(";
			$variables = $query->getVariables();
			$var_count = count($variables);
			$variables = array_values($variables);
			for($i = 0; $i < $var_count; ++$i){
				$variable = $variables[$i];
				echo $variable->getType() . " $" . $variable->getName();
				if($i !== $var_count - 1){
					echo ", ";
				}
			}
			echo ") : array{" . PHP_EOL;
			echo "\t\treturn [" . PHP_EOL;
			foreach($variables as $variable){
				echo "\t\t\t\"" . $variable->getName() . "\" => $" . $variable->getName() . "," . PHP_EOL;
			}
			echo "\t\t];" . PHP_EOL;
			echo "\t}" . PHP_EOL;
		}
		echo "}" . PHP_EOL;
		$contents = ob_get_clean();
		file_put_contents($dir, $contents);
		echo "Done generating SqlStmtArgs.\n";
	}
}