$(document).ready(function(){
	$("#headlines").ticker({ effect: "slideUp", interval: 4000});

	$( "#search" ).click(function() {
  		$( "#search-form" ).focus();
	});
    hide_labels();
});

function hide_labels () {
    $("#nama_label").hide();
    $("#email_label").hide();
    $("#email_label_invalid").hide();
    $("#komentar_label").hide();
}

$(document).ready(function() {
    $('#btn-kirim').click(function() {
        var nama = $('#nama').val();
        var email = $('#email').val();
        var komentar = $('#komentar').val();

        $('#nama_label, #email_label, #email_label_invalid, #komentar_label').hide();

        $.ajax({
            url: 'lib/buku_tamu-response.php',
            type: 'POST',
            data: { nama: nama, email: email, komentar: komentar },
            dataType: 'json',
            success: function(response) {
                if (response.type === 'error') {
                    if (response.errors.nama) $('#nama_label').show();
                    if (response.errors.email) $('#email_label').show();
                    if (response.errors.email_invalid) $('#email_label_invalid').show();
                    if (response.errors.komentar) $('#komentar_label').show();
                } else if (response.type === 'sukses') {
                    $('#buku-modal').modal('hide');
                    $('#snackbar').addClass('show');
                    setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
                    $('#kirim-buku-tamu')[0].reset();
                } else {
                    alert('Terjadi kesalahan: ' + response.message);
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat mengirim komentar.');
            }
        });
    });
});

$(window).load(function() {
    var boxheight = $('#myCarousel .carousel-inner').innerHeight();
    var itemlength = $('#myCarousel .item').length;
    var triggerheight = Math.round(boxheight/itemlength+1);
	$('#myCarousel .list-group-item').outerHeight(triggerheight);
});

new WOW().init();

function kirimPesan() {
    var nama = $('#nama').val();
    var email = $('#email').val();
    var subjek = $('#subjek').val();
    var pesan = $('#pesan').val();

    $.ajax({
        url: 'lib/kirim.php',
        type: 'POST',
        data: {
            nama_lengkap: nama,
            email: email,
            subjek: subjek,
            pesan: pesan
        },
        dataType: 'json',
        success: function(response) {
            if (response.type === 'error') {
                $('#hasil').html('<div class="alert alert-danger">' + response.messages.join('<br>') + '</div>');
            } else {
                $('#hasil').html('<div class="alert alert-success">' + response.text + '</div>');
                $('#formPesan')[0].reset();
            }
        },
        error: function() {
            $('#hasil').html('<div class="alert alert-danger">Terjadi kesalahan saat mengirim pesan.</div>');
        }
    });
}

$("#btn-kirim").on('click', function(){
    var data = $("#kirim-buku-tamu").serialize();
    $.ajax({
        url: 'lib/buku_tamu-response.php',
        type: 'post',
        dataType: 'json',
        data: data,
        beforeSend: function(){
            $('#btn-kirim').html("<i class='fa fa-circle-o-notch fa-spin margin-bottom'></i>&nbsp;&nbsp;MENGIRIM...");
            $('#btn-kirim').attr({"disabled":true});
        },
        success: function (data) {
            if (data.type=='sukses') {
                clear_form();
                hide_labels();
                $('#btn-kirim').attr({"disabled":false});
                $('#btn-kirim').html("<i class='fa fa-send'></i>&nbsp;&nbsp;KIRIM");
                $("#buku-modal").modal('hide');
                show_toast();
                console.log("Berhasil!");
            } else if (data.type=='error'){
                if (data.label=='all') {
                    $("#nama_label").show();
                    $("#email_label").show();
                    $("#komentar_label").show();
                } else if (data.label=='nama') {
                    $("#nama_label").show();
                } else if (data.label=='email') {
                    $("#email_label").show();
                } else if (data.label=='email_invalid') {
                    $("#email_label_invalid").show();
                } else if (data.label=='komentar') {
                    $("#komentar_label").show();
                }
                $('#btn-kirim').attr({"disabled":false});
                $('#btn-kirim').html("<i class='fa fa-send'></i>&nbsp;&nbsp;KIRIM");
                console.log("Gagal");
            } else if (data.type=='invalid'){
                $('#btn-kirim').attr({"disabled":false});
                $('#btn-kirim').html("<i class='fa fa-send'></i>&nbsp;&nbsp;KIRIM");
                console.log(data.message);
                alert(data.message);
            }
        }
    });
});

$("#btn-batal, .close").on('click',function(){
    clear_form();
});

function clear_form () {
    $("#nama").val("");
    $("#email").val("");
    $("#komentar").val("");
}

function show_toast() {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar")

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}