// Wade Arnold: 1/6/2008
// Example is designed to show how to send and recieve data to AMFPHP 2.0 using the NetConnection class in Flash CS3.
package {
	// required for flash file and output display
	import flash.display.MovieClip;
	import fl.events.*;
	import flash.events.*;
	// required to send/recieve data over AMF
	import flash.net.NetConnection;
	import flash.net.Responder;

	// Flash CS3 Document Class. 
	public class Main extends MovieClip {
		private var gateway:String = "http://localhost/amfphp/gateway.php";
		private var connection:NetConnection;
		private var responder:Responder;
		
		public function Main() {
			trace("AMFPHP HelloWorld Example");
			// Event listner for buttons
			send_btn.addEventListener(MouseEvent.CLICK, sendData);
			fault_btn.addEventListener(MouseEvent.CLICK, faultServer);
			// Responder to handle data returned from AMFPHP.
			responder = new Responder(onResult, onFault);
			connection = new NetConnection;
			// Gateway.php url for NetConnection
			connection.connect(gateway);
		}
	
		// Method run when the "Send To Server" button is clicked. 
		public function sendData(e:MouseEvent):void {
			trace("Sending Data to AMFPHP");
			// Get the data from the input field
			var params = server_txt.text;
			// Send the data to the remote server. 
			connection.call("HelloWorld.say", responder, params);
		}
		
		// Method run when the "Fault Server" button is pressed. 
		public function faultServer(e:MouseEvent):void {
			trace("Faulting AMFPHP");
			// Make a call to a service that does not exist. 
			connection.call("BadClass.noMethod", responder, "no paramaters");
		}
		
		// Handle a successful AMF call. This method is defined by the responder. 
		private function onResult(result:Object):void {
			response_txt.text = String(result);
		}
		
		// Handle an unsuccessfull AMF call. This is method is dedined by the responder. 
		private function onFault(fault:Object):void {
			response_txt.text = String(fault.description);
		}
	}
}