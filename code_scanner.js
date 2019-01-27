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
     var last_result = [];

     if(Quagga.initialized == undefined) {
          Quagga.onDetected(function(result) {
            var last_code = result.codeResult.code;
            last_result.push(last_code);
            if(last_result.length > 20) {
                code = order_by_occurence(last_result)[0];
                last_result = [];
                Quagga.stop();
                $.ajax({
                    url: 'input.inc.php',
                    data: {'code': code},
                    type: 'post',
                    success: (data) => {
                        window.location.replace("../show_item.html");
                    }
                });
            }
         });
     }

    Quagga.init({
        inputStream : {
            name : "Live",
            type : "LiveStream",
            numOfWorkers: navigator.hardwareConcurrency,
            target : document.querySelector('#barcode-scanner')
        },
        decoder: {
                readers : [{
                    format: "ean_reader",
                    config: {}
                }]
        }
     },function(err) {
         if(err) { console.log(err); return; }
         Quagga.initialized = true;
         Quagga.start();
   });
  }
};
$(document).on('turbolinks:load', load_quagga);
