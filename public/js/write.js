$('#write').click(function (e) {
    e.preventDefault();
    var username = $("#card_name").val();
    // let rString = randomString(16, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

    let rString = $('#nfc_id').val();
    const data = {
        name: username,
        nfcid: rString
    };

    alert(data);

    
    if((username =='' || username ==null || typeof(username) === "undefined" )&& (rString == '')){
      alert('Form data is required!');
      return false;
    }

    $.ajax({
        type: "post",
        url: siteURL +"add.php",
        data: {
            name: username,
            nfcid: rString
        },
        success: function(result) {
            var obj = JSON.parse(result);
            if(obj == true){
                alert('Data Successfully Write In Card');
            }else{
                alert('Something went wrong')
            }
        },
        error: function(result) {
            alert('error');
        }
    });


    const encoder = new TextEncoder();

    const jsonRecord = {
        recordType: "mime",
        mediaType: "application/json",
        data: encoder.encode(JSON.stringify(data))
    };
    const writer = new NDEFWriter();
    writer.push(
        { records: [jsonRecord] }
    ).then(() => {
        alert("Message written.");
    }).catch(error => {
        alert(`Write failed :-( try again: ${error}.`);
    });
});

function randomString(length, chars) {
    var result = '';
    for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
    return result;
}
