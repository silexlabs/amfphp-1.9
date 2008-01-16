// Wade Arnold: 1/16/2008
// Example is designed to show how to use amfphp to populate a fl.controls.datagrid. 
// TODO: Add method to update the dataset array. 
// TODO: Add an additional call that shows how to get data from a database. 
// TODO: Add a method to update the database dataset. 

package {
	// required for flash file and output display
	import flash.display.MovieClip;
	import fl.events.*;
	import flash.events.*;
	// required to send/recieve data over AMF
	import flash.net.NetConnection;
	import flash.net.Responder;
	// required for the datagrid
	import fl.controls.DataGrid;
	//import fl.controls.dataGridClasses.DataGridColumn;
	import fl.data.DataProvider;
	
	// Flash CS3 Document Class. 
	public class Main extends MovieClip {
		private var gateway:String = "http://localhost/amfphp/gateway.php";
		private var connection:NetConnection;
		private var responder:Responder;
		// DataGrid on the stage
		private var myDg:DataGrid;
		// Dataprovider for the DataGrid
		private var dp:DataProvider;
		
		public function Main() {
			trace("AMFPHP DataGrid Example");
			// Create the new dataprovider
			dp = new DataProvider();
			myDG.dataProvider = dp;
			
			// Responder to handle data returned from AMFPHP.
			responder = new Responder(onResult, onFault);
			connection = new NetConnection;
			
			// Gateway.php url for NetConnection
			connection.connect(gateway);
			// Ask for the data on the load of the flash file. 
			connection.call("DataGrid.getDataSet", responder);
		}

		// Handle a successful AMF call. This method is defined by the responder. 
		private function onResult(result:Object):void {
			// Add the data that was returned from ther service into the Dataprovider. 
			dp.addItems(result);
			// Debug: Just showing how large the dataset is. 
			trace("Rows Returned: "+dp.length);
		}
		
		// Handle an unsuccessfull AMF call. This is method is dedined by the responder. 
		private function onFault(fault:Object):void {
			trace(String(fault.description));
		}
	}
}