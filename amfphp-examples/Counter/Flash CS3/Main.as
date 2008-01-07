// Wade Arnold: 1/6/2008
// Example is designed to show how to use PHP sessions. 
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
			trace("AMFPHP Session Counter Example");
			// Event listner for buttons
			increment_btn.addEventListener(MouseEvent.CLICK, incrementCounter);
			reset_btn.addEventListener(MouseEvent.CLICK, resetCounter);
			destroy_btn.addEventListener(MouseEvent.CLICK, destroySession);
			// Responder to handle data returned from AMFPHP.
			responder = new Responder(onResult, onFault);
			connection = new NetConnection;
			// Gateway.php url for NetConnection
			connection.connect(gateway);
		}
	
		// Method run when the "Increment Counter" button is clicked. 
		public function incrementCounter(e:MouseEvent):void {
			// Send the data to the remote server. 
			connection.call("Counter.increment", responder);
		}
		// Method run when the "Rest Counter" button is clicked. 
		public function resetCounter(e:MouseEvent):void {
			// Send the data to the remote server. 
			connection.call("Counter.unregister", responder);
		}
		
		// Method run when the "Destroy Session" button is clicked. 
		public function destroySession(e:MouseEvent):void {
			// Send the data to the remote server. 
			connection.call("Counter.destroy", responder);
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