function test() {
  alert("test");
}

function order_by_occurence(arr) {
    var counts = {}
    arr.forEach(function(value){
        if(!counts[value])
        {
            counts[value] = 0;
        }
        counts[value]++;
    });
    return Object.keys(counts).sort(function(curKey,nextKey) {
        return counts[curKey] = counts[nextKey];
    });
}

function load_quagga(){
 if($('#barcode-scanner').length > 0 && typeof navigator.mediaDevices.getUserMedia === 'function'){
   console.log(navigator);

    /*var last_result = [];
    if(Quagga.initialized == undefined) {
    Quagga.onDetected(function(result) {
       var last_code = result.codeResult.code;
       last_result.push(last_code);
       if(last_result.length > 10) {
       code - order_by_occurence(last_result)[0];
       Quagga.stop();
       $.ajax({
           type: "POST"
           url: '/products.get_barcode',
           data: {upc: last code}
          });
       }
    });
   }   */

    Quagga.init({
        inputStream : {
            name : "Live",
            type : "LiveStream",
            numOfWorkers: navigator.hardwareConcurrency,
            target : document.querySelector('#barcode-scanner')
        },
        decoder: {
            reader: ['ean_reader','ean_8_reader','code_39_reader','code_39_vin_reader','codabar_reader','upc_reader','upc_e_reader']
        }
     },function(err) {
         if(err) { console.log(err); return; }
         Quagga.start();

 });

}
};
