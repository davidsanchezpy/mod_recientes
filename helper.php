 <?php
/**
 * Helper class for Documentos Recientes! module
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class ModRecientesHelper {
    /**
     * Retrieves the hello message
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getHello($params) {
        // Obtenemos la conexión a la DB
        $db = JFactory::getDbo();
        // Creamos el Query
        $query = $db->getQuery(true);

		$sql_arc_rec = "SELECT * FROM xxxxx_phocadownload WHERE published=1 ORDER BY id DESC limit 10"; // cambiar el nombre de la tabla del phocadownload, por la que tenemos con el prefijo correspondiente..
        $db->setQuery($sql_arc_rec); // aplicar consulta
        $busquedas_arc_rec = $db->loadObjectList(); // ejecutar consulta y devolver resultado

        foreach ($busquedas_arc_rec as $row_ar) {
            $id_arc = $row_ar->id;
            $id_categoria = $row_ar->catid;
            $alias_archivo =$row_ar->alias;

            $sql_cat = "SELECT alias FROM xxxxx_phocadownload_categories WHERE id = $id_categoria"; // cambiar el nombre de la tabla del phocadownload_categories por el que tenemos con el prefijo correspondiente
            $db->setQuery($sql_cat); // aplicar consulta
            $busqueda_cat = $db->loadObjectList();
            $alias_categoria = $busqueda_cat[0]->alias;
    
            $paramatro[] = '<p class="pdf"><a href="'. $_SERVER['SCRIPT_NAME'] .'/categorias-de-archivos/category/'. $id_categoria .'-'. $alias_categoria .'?download='. $id_arc .' :'. $alias_archivo .'">'. $row_ar->title .'</a></p>';
        }
        
        return $paramatro;
    }
}