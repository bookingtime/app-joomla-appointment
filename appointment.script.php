<?php
/**
 * @package    COM_BT_APPOINTMENT
 * @author     bookingtime GmbH <support@bookingtime.com>
 * @copyright  Copyright (c) 2014 bookingtime GmbH. All Rights Reserved.
 * @license    MIT; see LICENSE.txt
 */

defined( '_JEXEC' ) or die();

use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Installer\Installer;
use Joomla\CMS\Installer\InstallerScript;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

/**
 * Updates the database structure of the component
 *
 * @since  1.0.0
 */
class Com_AppointmentInstallerScript extends InstallerScript {

	/**
	 * The title of the component (printed on installation and uninstallation messages)
	 *
	 * @var  string
	 */
	protected $extension = 'Appointment';

	/**
	 * The minimum Joomla! version required to install this extension
	 *
	 * @var  string
	 */
	protected $minimumJoomla = '4.0';

	/**
	 * Constructor
	 *
	 * @param   InstallerAdapter  $adapter  The object responsible for running this script
	 */
	public function __construct(InstallerAdapter $adapter)
	{
	}

	/**
	 * Method called before install/update the component
	 *
	 * Note: This method won't be called during uninstall process
	 *
	 * @param   string  $type    Type of process [install | update]
	 * @param   mixed   $parent  Object who called this method
	 *
	 * @return  boolean  True if the process should continue, false otherwise
	 *
	 * @since   1.0.0
     * @throws  Exception
	 */
	public function preflight( $type, $parent )	{
		$result = parent::preflight( $type, $parent );

		if ( ! $result ) {
			return $result;
		}

		// logic for preflight before install
		return $result;
	}

	/**
	 * Method to install the component
	 *
	 * @param   mixed  $parent  Object who called this method.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function install( $parent ) {
		$this->installModules( $parent );
	}

	/**
	 * Method to update the component
	 *
	 * @param   mixed  $parent  Object who called this method.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function update( $parent ) {
		$this->installModules( $parent );
	}

	/**
	 * Method called after install/update the component.
	 *
	 * @param   string  $type    type
	 * @param   string  $parent  parent
	 *
	 * @return  boolean
	 *
	 * @since   1.0.0
	 */
	public function postflight( $type, $parent ) {
		return true;
	}

	/**
	 * Method to uninstall the component
	 *
	 * @param   mixed  $parent  Object who called this method.
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function uninstall( $parent ) {
		$this->uninstallModules( $parent );
	}

	/**
	 * Installs modules for this component
	 *
	 * @param   mixed  $parent  Object who called the install/update method
	 *
	 * @return  void
	 *
	 * @since  2.0.0
	 */
	private function installModules( $parent ) {
		$installation_folder = $parent->getParent()->getPath( 'source' );
		$app = Factory::getApplication();

		if ( method_exists( $parent, 'getManifest' ) ) {
			$modules = $parent->getManifest()->modules;
		} else {
			$modules = $parent->get( 'manifest' )->modules;
		}

		if ( ! empty( $modules ) ) {
			if ( count( $modules->children() ) ) {
				foreach ( $modules->children() as $module ) {
					$moduleName = (string) $module['module'];
					$path       = $installation_folder . '/modules/' . $moduleName;
					$installer  = new Installer;

					if ( ! $this->isAlreadyInstalled( 'module', $moduleName ) )	{
						$result = $installer->install( $path );
					} else {
						$result = $installer->update( $path );
					}


					if ( $result ) {
						$app->enqueueMessage(
							Text::sprintf(
								'Module "%s" was installed successfully',
								($moduleName == '' ? 'bookingtime Appointment' : $moduleName)
							)
						);
					} else {
						$app->enqueueMessage(
							Text::sprintf(
								'There was an issue installing the module "%s"',
								($moduleName == '' ? 'bookingtime Appointment' : $moduleName)
							),
							'error'
						);
					}
				}
			}
		}
	}


	/**
	 * Uninstalls modules
	 *
	 * @param   mixed  $parent  Object who called the uninstall method
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	private function uninstallModules( $parent ) {
		$app = Factory::getApplication();

		if ( method_exists( $parent, 'getManifest' ) ) {
			$modules = $parent->getManifest()->modules;
		} else {
			$modules = $parent->get( 'manifest' )->modules;
		}

		if ( ! empty( $modules ) ) {
			if ( count( $modules->children() ) ) {
				$db    = Factory::getDbo();
				$query = $db->getQuery( true );

				foreach ( $modules->children() as $module ) {
					$moduleName = (string) $module['module'];
					$query
						->clear()
						->select( 'extension_id' )
						->from( '#__extensions' )
						->where(
							array(
								'type LIKE ' . $db->quote( 'module' ),
								'element LIKE ' . $db->quote( $moduleName )
							)
						);
					$db->setQuery( $query );
					$extension = $db->loadResult();

					if ( ! empty( $extension ) ) {
						$installer = new Installer;
						$result    = $installer->uninstall( 'module', $extension );

						if ( $result ) {
							$app->enqueueMessage(
								Text::sprintf(
									'Module "%s" was uninstalled successfully',
									$moduleName
								)
							);
						} else {
							$app->enqueueMessage(
								Text::sprintf(
									'There was an issue uninstalling the module "%s"',
									$moduleName
								),
								'error'
							);
						}
					}
				}
			}
		}
	}

	/**
	 * Checks if a certain table exists on the current database
	 *
	 * @param   string   $table_name  Name of the table
	 *
	 * @return  boolean  True if it exists, false if it does not
	 *
	 * @since   2.0.0
	 */
	private function existsTable( $table_name ) {
		$db = Factory::getDbo();
		$table_name = str_replace( '#__', $db->getPrefix(), (string) $table_name );
		return in_array( $table_name, $db->getTableList() );
	}

	/**
	 * Check if an extension is already installed in the system
	 *
	 * @param   string  $type    Extension type
	 * @param   string  $name    Extension name
	 * @param   mixed   $folder  Extension folder(for plugins)
	 *
	 * @return  boolean
	 *
	 * @since  2.0.0
	 */
	private function isAlreadyInstalled( $type, $name, $folder = null )	{
		$result = false;

		switch ( $type ) {
			case 'plugin':
				$result = file_exists( JPATH_PLUGINS . '/' . $folder . '/' . $name );
				break;
			case 'module':
				$result = file_exists( JPATH_ROOT . '/modules/' . $name );
				break;
		}

		return $result;
	}




}
