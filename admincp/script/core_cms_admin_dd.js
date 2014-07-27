/*
Copyright © Yahoo! Inc. 2008, All Rights Reserved

* Redistributions in source code form must contain the copyright notice "Copyright © Yahoo! Inc. 2008, All Rights Reserved", this list of conditions, and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice, this list of conditions, and the following disclaimer in the documentation and/or other materials provided with the distribution.
* Neither the name of Yahoo! nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission of Yahoo!.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

(function() {

var Dom = YAHOO.util.Dom;
var Event = YAHOO.util.Event;
var DDM = YAHOO.util.DragDropMgr;

YAHOO.DDApp = {
	init: function()
	{
		var ultags;

		if (document.all) {
			ultags = document.all.tags('ul');
		}
		else if (document.getElementsByTagName) {
			ultags = document.getElementsByTagName('ul');
		}
		
		for (var i=0; i < ultags.length; i++) {
			new YAHOO.util.DDTarget(ultags[i].id);
		}

		var litags;
		if (document.all) {
			litags = document.all.tags('li');
		}
		else if (document.getElementsByTagName) {
			litags = document.getElementsByTagName('li');
		}
		
		for (var i=0; i < litags.length; i++) {
			new YAHOO.DDList(litags[i].id);
		}
	},

	showOrder: function() {
		var parseList = function(ul) {
			var items = ul.getElementsByTagName("li");
			var out = "";
			for (i=0;i<items.length;i=i+1) {
				out += items[i].id + " ";
			}
			return out;
		};

		var colobj = fetch_object("columns").value;
		var columnids = colobj.split(",");

		for (i in columnids)
		{
			colid = columnids[i];
			document.getElementById("col" + colid).value = parseList(Dom.get("ul" + colid));
		}
	}
};

//////////////////////////////////////////////////////////////////////////////
// custom drag and drop implementation
//////////////////////////////////////////////////////////////////////////////

YAHOO.DDList = function(id, sGroup, config) {

	YAHOO.DDList.superclass.constructor.call(this, id, sGroup, config);

	this.logger = this.logger || YAHOO;
	var el = this.getDragEl();
	Dom.setStyle(el, "opacity", 0.85); // The proxy is slightly transparent

	this.goingUp = false;
	this.lastY = 0;
};

YAHOO.extend(YAHOO.DDList, YAHOO.util.DDProxy, {

	startDrag: function(x, y) {
		this.logger.log(this.id + " startDrag");

		// make the proxy look like the source element
		var dragEl = this.getDragEl();
		var clickEl = this.getEl();

		inactColumn = false;
		if (clickEl.parentNode.id) {
			inactColumn = true;
		}
		Dom.setStyle(clickEl, "visibility", "hidden");

		dragEl.innerHTML = clickEl.innerHTML;
	},

	endDrag: function(e) {

		var srcEl = this.getEl();
		var proxy = this.getDragEl();

		// Show the proxy element and animate it to the src element's location
		Dom.setStyle(proxy, "visibility", "");
		var a = new YAHOO.util.Motion( 
			proxy, { 
				points: { 
					to: Dom.getXY(srcEl)
				}
			}, 
			0.05, 
			YAHOO.util.Easing.easeOut 
		)
		var proxyid = proxy.id;
		var thisid = this.id;

		// Hide the proxy and show the source element when finished with the animation
		a.onComplete.subscribe(function() {
				Dom.setStyle(proxyid, "visibility", "hidden");
				Dom.setStyle(thisid, "visibility", "");
			});
		a.animate();
	},

	onDragDrop: function(e, id) {

		// If there is one drop interaction, the li was dropped either on the list,
		// or it was dropped on the current location of the source element.
		if (DDM.interactionInfo.drop.length === 1) {

			// The position of the cursor at the time of the drop (YAHOO.util.Point)
			var pt = DDM.interactionInfo.point; 

			// The region occupied by the source element at the time of the drop
			var region = DDM.interactionInfo.sourceRegion; 

			// Check to see if we are over the source element's location.  We will
			// append to the bottom of the list once we are sure it was a drop in
			// the negative space (the area of the list without any list items)
			if (!region.intersect(pt)) {
				var destEl = Dom.get(id);
				var destDD = DDM.getDDById(id);
				destEl.appendChild(this.getEl());
				destDD.isEmpty = false;
				DDM.refreshCache();
			}

			Dom.setStyle(id, "border", "1px dashed gray");
		}

		this.showOrder;

	},

	onDrag: function(e) {

		// Keep track of the direction of the drag for use during onDragOver
		var y = Event.getPageY(e);

		if (y < this.lastY) {
			this.goingUp = true;
		} else if (y > this.lastY) {
			this.goingUp = false;
		}

		this.lastY = y;
	},

	onDragOver: function(e, id) {
	
		var srcEl = this.getEl();
		var destEl = Dom.get(id);
		// We are only concerned with list items, we ignore the dragover
		// notifications for the list.
		if (destEl.nodeName.toLowerCase() == "li") {
			var orig_p = srcEl.parentNode;
			var p = destEl.parentNode;

			if (this.goingUp) {
				p.insertBefore(srcEl, destEl); // insert above
			} else {
				p.insertBefore(srcEl, destEl.nextSibling); // insert below
			}

			DDM.refreshCache();
		}
		else
		{
			Dom.setStyle(id, "border", "1px dashed red");
		}
	},

	onDragOut: function(e, id) {
		var destEl = Dom.get(id);
		// Update the list border
		if (destEl.nodeName.toLowerCase() == "ul") {
			Dom.setStyle(id, "border", "1px dashed gray");
		}
	}

});

Event.onDOMReady(YAHOO.DDApp.init, YAHOO.DDApp, true);

})();