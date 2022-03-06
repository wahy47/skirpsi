$(document).ready(function () {

    // transportasi

        $hgRental = 0;
        $hgWisata = 0;
        $hgResto = 0;
        $hgHotel = 0;
        $hgTrans = 0;
        $hgMin = 0;
        $hgMax = 0;

    // $('#tmbl').prop("disabled", true);

    $('.row-wisata').click(function(){
        disable();
    })




    $('input[name=transportation]').click(function () {
        $('#hg-trans').html($(this).val());
        $hgTrans = $('#hg-trans').html();
        // total()
    });

    $('.transportation').click(function (){
        $nama = $(this).find('h6').html();
        $('#nm-trans').html($nama);
        
    });

    // hotel
    $('input[name=hotel]').click(function () {
        if($(this).is(':checked')){
            $('#nm-hotel').html($nama);
            $('#hg-hotel').html($kelas1);
            $hgHotel = $('#hg-hotel').html();

        }

        // else{
        //     alert('aowkwok');
        //     $select.attr('disabled', 'disabled');
        // }
        // $harga = 
        // $('#hg-hotel').html($(this).find(":selected").val(););
        // alert($nama);
        // $kelas = "";
        // $('#hg-hotel').html($kelas)
        
        // alert($kelas);

    });

    $('.hotel').click(function (){
        $select = $(this).find('select');
        $kelas = $(this).find(":selected").val();
        $nama = $(this).find('h6').html();
        
        $kelas1 = $kelas;
        $(this).find('.price').html($kelas1);
       
        
        $(this).find('.kelas').change(function(){
            $kelas = $(this).find(":selected").val();
            
        });
       

    });

    


    // $('input[name=restaurant]').click(function () {
    //     $('#hg-resto').html($(this).val());
    //     $hgResto = $('#hg-resto').html();
    // });

    // $('.resto').click(function (){
    //     $nama = $(this).find('h6').html();
    //     $('#nm-resto').html($nama);
       
    // });

    $('input[name=restaurant]').click(function () {

        if($(this).is(':checked')){
            $('#nm-resto').append('<div>'+$namaResto+'</div>');

            $('#hg-resto').append('<div>'+$(this).val()+'</div>');
            $hgResto += parseInt($(this).val());
            $hgMin += parseInt($(this).data('hgmin')); 
            // $hgMax = 
            
            
        }

        else{
            $('#nm-resto div').last().remove();
            $('#hg-resto div').last().remove();
            $hgResto -= parseInt($(this).val());
            $hgMin -= parseInt($(this).data('hgmin'));

        }
        // alert($hgResto);

        

        // $hgResto = $('#hg-resto div').html();
    });

    $('.resto').click(function (){
        $namaResto = $(this).find('h6').html();
        
    });
    
    $('input[name=wisata]').click(function () {

        if($(this).is(':checked')){
            $('#nm-wisata').append('<div>'+$nama+'</div>');

            $('#hg-wisata').append('<div>'+$(this).val()+'</div>');
            $hgWisata += parseInt($(this).val());
            // alert($hgWisata);
            
        }

        else{
            $('#nm-wisata div').last().remove();
            $('#hg-wisata div').last().remove();
            $hgWisata -= parseInt($(this).val());
        }


    });

    $('.wisata').click(function (){
        $nama = $(this).find('h6').html();
        
    });
    $('input[name=rental]').click(function () {
        $('#hg-rental').html($(this).val());
        $hgRental = $('#hg-rental').html();
    });


    $('.rental').click(function (){
        $nama = $(this).find('h6').html();
        $('#nm-rental').html($nama);
       
        
    });

    $('#orang').change(function(){
        $jmOrang = $('#jmOrang').html($('#orang').val());
    })

    function total() {
        $jmOrang = parseInt($('#jmOrang').html());
        $total = parseInt($hgHotel) + parseInt($hgResto) + parseInt($hgTrans) + parseInt($hgWisata) + parseInt($hgRental);  
        $('#hg-total').html($total*$jmOrang);
        $totalHarga = $('#hg-total').html();
        $totalHargaMin = (parseInt($hgHotel) + parseInt($hgMin) + parseInt($hgTrans) + parseInt($hgWisata) + parseInt($hgRental))*$jmOrang;
    }

    function disable(){
        // alert($hgHotel);
        if(parseInt($hgHotel) == 0 || parseInt($hgResto) == 0 || parseInt($hgTrans) == 0 || parseInt($hgWisata) == 0){
            
            // $('#tmbl').prop("disabled", true);
        }
    
        else{
            // $('#tmbl').prop("disabled", false);
        }
    }
    

    $('#tmbl').click(function () {
        total();
  
        $('#totalHarga').html($totalHarga);
        $('#totalHargaMin').html($totalHargaMin);
        $text = "Minimal : IDR "+$totalHargaMin+"\n"+"Maximal : IDR "+$totalHarga;
        $bebas = $('.alert-login-berhasil').data('flashdata');
        Swal.fire({
            position: 'middle',
            title: 'Total Biaya Estimasi',
            html: '<pre>'+$text+'</pre>',
       });

    })


    $(function () {
        $('#datetimepicker1').datetimepicker();
    });

    $('#tess').click(function(){
        alert($('.hotel').height());
    });


});
var nav = document.querySelector('nav');

window.addEventListener('scroll', function () {
    if (window.pageYOffset > 250) {
        nav.classList.add('bg-hitam', 'shadow');
    } else {
        nav.classList.remove('bg-hitam', 'shadow');
    }
    
});