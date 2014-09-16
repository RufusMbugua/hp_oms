<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ArrayCache,
	Doctrine\Common\Annotations\AnnotationReader,
	Doctrine\ORM\Mapping\Driver\AnnotationDriver,
    Doctrine\DBAL\Logging\EchoSqlLogger,
	Doctrine\DBAL\Event\Listeners\MysqlSessionInit,
	Doctrine\ORM\Tools\SchemaTool,
	Doctrine\Common\EventManager;

/**
 * CodeIgniter Doctrine Library
 *
 * Doctine 2 wrapper for Codeigniter 
 *
 * @category		Libraries
 * @author			Rubén Sarrió <rubensarrio@gmail.com>
 * @link 				https://github.com/rubensarrio/codeigniter-hmvc-doctrine
 * @version			1.1
 */
class Doctrine {
	
    public $em = null;
    public $tool = null;
 
    public function __construct()
  	{	
	    // Is the config file in the environment folder?
		if ( ! defined('ENVIRONMENT') OR ! file_exists($file_path = APPPATH.'config/'.ENVIRONMENT.'/database.php'))
		{
			$file_path = APPPATH.'config/database.php';
		}
	    // load database configuration from CodeIgniter
	    require $file_path;
	    
		// Set up class loading
	    require_once APPPATH
				.'third_party/doctrine-orm/Doctrine/Common/ClassLoader.php';
	 
	    $loader = new ClassLoader('Doctrine', APPPATH
				.'third_party/doctrine-orm');
	    $loader->register();
		
		// Set up models loading
		$loader = new ClassLoader('models', APPPATH);
		$loader->register();
		foreach (glob(APPPATH.'modules/*', GLOB_ONLYDIR) as $m) {
			$module = str_replace(APPPATH.'modules/', '', $m);
			$loader = new ClassLoader($module, APPPATH.'modules');
			$loader->register();
		}

		// Set up proxies loading
	    $loader = new ClassLoader('Proxies', APPPATH.'Proxies');
	    $loader->register();
 		
	    // Set up caches
	    $config = new Configuration;
	    $cache = new ArrayCache;
	    $config->setMetadataCacheImpl($cache);
	    $config->setQueryCacheImpl($cache);
 
	    // Set up driver
	    $reader = new AnnotationReader($cache);
	    $reader->setDefaultAnnotationNamespace('Doctrine\ORM\Mapping\\');
    
		// Set up models
		$models = array(APPPATH.'models');
		foreach (glob(APPPATH.'modules/*/models', GLOB_ONLYDIR) as $m)
			array_push($models, $m);
		$driver = new AnnotationDriver($reader, $models);

    	$config->setMetadataDriverImpl($driver);
 
	    // Proxy configuration
	    $config->setProxyDir(APPPATH.'/Proxies');
	    $config->setProxyNamespace('Proxies');
 
	    // Set up logger
	    //$logger = new EchoSqlLogger;
	    //$config->setSqlLogger($logger);
 
    	$config->setAutoGenerateProxyClasses( TRUE );
		
	    // Database connection information
	    $connection = array(
	        'driver' => 'pdo_mysql',
	        'user' =>     $db[$active_group]['username'],
	        'password' => $db[$active_group]['password'],
	        'host' =>     $db[$active_group]['hostname'],
	        'dbname' =>   $db[$active_group]['database']
	    );
 
	    // Create EntityManager
	    $this->em = EntityManager::create($connection, $config);
			
		// Force UTF-8
		$this->em->getEventManager()->addEventSubscriber(
			new MysqlSessionInit('utf8', 'utf8_unicode_ci'));
		
		// Schema Tool
		$this->tool = new SchemaTool($this->em);

		//auto generate entities from database
		//$this->generate_entities();
	}

	public function generate_entities()
	{
		// custom datatypes (not mapped for reverse engineering)
		$this -> em -> getConnection() -> getDatabasePlatform() -> registerDoctrineTypeMapping('set', 'string');
		$this -> em -> getConnection() -> getDatabasePlatform() -> registerDoctrineTypeMapping('enum', 'string');
		$this -> em -> getConnection() -> getDatabasePlatform() -> registerDoctrineTypeMapping('blob', 'string');

		// fetch metadata
		$driver = new \Doctrine\ORM\Mapping\Driver\DatabaseDriver($this -> em -> getConnection() -> getSchemaManager());

		$driver -> setNamespace('models\\Entities\\');
		//set driver implementation
		$this -> em -> getConfiguration() -> setMetadataDriverImpl($driver);

		$cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory($this -> em);
		$cmf -> setEntityManager($this -> em);
		$classes = $driver -> getAllClassNames();

		//get class metadata
		$metadata = $cmf -> getAllMetadata();
		$generator = new \Doctrine\ORM\Tools\EntityGenerator();
		$generator -> setGenerateAnnotations(TRUE);
		$generator -> setGenerateStubMethods(TRUE);
		$generator -> setRegenerateEntityIfExists(TRUE);
		$generator -> setUpdateEntityIfExists(TRUE);
		$generator -> setBackupExisting(FALSE);
		try {
			$generator -> generate($metadata, APPPATH . 'models/Entities');
			print 'Done!';
		} catch(exception $ex) {
			die($ex -> getMessage());
		}
	}
}

// END Doctrine class

/* End of file Doctrine.php */
/* Location: ./application/libraries/Doctrine.php */