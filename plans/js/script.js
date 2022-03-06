 let parameter = {
        orang:"1",
        hari:"1",
        transportasi: "",
        ctransportasi:"",
        bus:"",
        hotel: "",
        hoteltransit:"",
        rumah_makan: 
            [
                
            ],
        wisata: [],
        rental:[],
        kelas:"",
        kelastransit:"",
        hmax:"",
        hmin:"",
        jrental:[]
        
    }

 function selecttrans (e) {
        $final = e.getAttribute('value');
        $('#hg-trans').html($final);
        $hgTrans = $('#hg-trans').html();
        // total()
    };
function label(e){
    $nama = e.getElementsByTagName('h6')[0].innerText;
    $('#nm-trans').html($nama);
    parameter.ctransportasi=$nama;
}
function hoteltransit(e){
    $nama = e.getElementsByTagName('h6')[0].innerText;
    $kelas = e.getElementsByTagName('select')[0].value;
    $('#nm-hotelt').html($nama);
    $('#hg-hotelt').html($kelas);
    $hgHotelt = $('#hg-hotelt').html();
    parameter.hoteltransit=$nama;
    parameter.kelastransit=$kelas;
    
}
function bus(e){
    $nama = e.getElementsByTagName('h6')[0].innerText;
    parameter.bus=$nama;
    var tlp = e.getElementsByTagName('span')[0].innerText;
    var numb = tlp.match(/\d/g);
    numb = numb.join("");
    $('#nm-transk').html($nama);
    $('#hg-transk').html(numb);
}

let $hgTrans = "";
let $hgHotelt="";

$(document).ready(function () {

      
    // transportasi

        $hgRental = 0;
        $hgWisata = 0;
        $hgResto = 0;
        $hgHotel = 0;
        $hgTrans = 0;
        $hgMin = 0;
        $hgMax = 0;
        $jmHari =1;
        $jmOrang = 1;
        $jrental = 1;

    // $('#tmbl').prop("disabled", true);

    $('.row-wisata').click(function(){
        disable();
    })

    $asal = $('#tujuan').find(":selected").val();
    $x = $('#tujuan').find('option:selected').text();
    $('.hg-asal').html(numberWithCommas($asal));
    $('#plane').val($asal);
    $('#tujuan').click(function(){
        $asal = $(this).find(":selected").val();
        $x = $(this).find(":selected").text();
        // alert($asal)
        $('#plane').val($asal);
        $('.nm-asal').html($x);
        $('.hg-asal').html(numberWithCommas($asal));
        parameter.transportasi=$x;
        
    })

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    


    // $('input[name=transportation]').click(function () {
    //     $final = $(this).val();
    //     $('#hg-trans').html($final);
    //     $hgTrans = $('#hg-trans').html();

    //     // total()
    // });

    // $('.transportation').click(function (){
    //     $nama = $(this).find('h6').html();
    //     $('#nm-trans').html($nama);
    //     parameter.ctransportasi=$nama;
        
        
    // });

    // hotel
    $('input[name=hotel]').click(function () {
        if($(this).is(':checked')){
            $('#nm-hotel').html($nama);
            $('#hg-hotel').html($kelas1);
            $hgHotel = $('#hg-hotel').html();

        }

    });

    $('.hotel').click(function (){
        $select = $(this).find('select');
        $kelas = $(this).find(":selected").val();
        $nama = $(this).find('h6').html();
        console.log($nama);
        parameter.hotel=$nama;
        $kelas1 = $kelas;
        parameter.kelas=$kelas;
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
        parameter.rumah_makan.push($namaResto);
        
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
        parameter.wisata.push($nama);
        
    });
    $nama_rt = "";
    $harga_rt = "";
    $('input[name=rental]').click(function () {
        if($(this).is(':checked')){
            $('#nm-rental').append('<div>'+$nama+'</div>');

            $('#hg-rental').append('<div>'+$(this).val()+'</div>');
            $hgRental += parseInt($(this).val());
            //for(let i = 0 ; i < parameter.jrental.length; i++){
            if (parameter.jrental.nama != $nama_rt) {
                parameter.jrental.push({
                    nama:$nama,
                    value:0,
                    harga:0

                })
            //}
        }
            //alert($jrental);
            
        }

        else{
            $('#nm-rental div').last().remove();
            $('#hg-rental div').last().remove();
            $hgRental -= parseInt($(this).val());
            for(let i = 0; i < parameter.jrental.length; i++){
                if (parameter.jrental[i].nama == $nama_rt) {
                    parameter.jrental.splice(i,1)
                }
            }
        }
        console.log(parameter.jrental)
    });



    $('.rental').click(function (){
        $nama = $(this).find('h6').html();
        $nama_rt = $nama;
        //console.log($(this).attr('dataharga'));
        
        //parameter.jrental.push($jrental);

        // $(this).find('.jrental').on('change', function(){
        //  console.log($(this).val());   
        //})
        
    });
    $('.jrental').on('change',function(){
         //console.log($(this).attr('datanama'));
         //console.log($(this).attr('dataharga'));
         let nm_rental = $(this).attr('datanama');
         let j_rental = $(this).val();
         let hg_rental = $(this).attr('dataharga');
        
         for(let i =0 ; i < parameter.jrental.length; i++){
         if (parameter.jrental[i].nama == nm_rental) {
            parameter.jrental[i].value=j_rental;
            parameter.jrental[i].harga=parseInt(hg_rental)*parseInt(j_rental);

         }
         }
         console.log(parameter.jrental)
    });

    // $('.hotel').click(function (){
    //     $select = $(this).find('select');
    //     $kelas = $(this).find(":selected").val();
    //     $nama = $(this).find('h6').html();
    //     parameter.hotel=$nama;
    //     $kelas1 = $kelas;
    //     parameter.kelas=$kelas;
    //     $(this).find('.price').html($kelas1);
       
        
    //     $(this).find('.kelas').change(function(){
    //         $kelas = $(this).find(":selected").val();
            
    //     });
       

    // });

    $('#orang').change(function(){
        $jmOrang = $('#jmOrang').html($('#orang').val());
        
    })

    $('#orangPlus').click(function(){
        $jmOrang = $('#jmOrang').html(parseInt($('#orang').val())+1)

    })
    $('#orangMinus').click(function(){
        $jmOrang = $('#jmOrang').html(parseInt($('#orang').val())-1)
    })

    $('#hari').change(function(){
        $jmHari = $('#hari').val();
        $('#jmHari').html($jmHari);
        
    })

    $('#hariPlus').click(function(){
        $jmHari = parseInt($('#hari').val())+1;
        $('#jmHari').html($jmHari);

    })
    $('#hariMinus').click(function(){
        $jmHari = parseInt($('#hari').val())-1;
        $('#jmHari').html($jmHari);

    })


    function total() {
        $jmOrang = parseInt($('#jmOrang').html());
        $jmHari = parseInt($('#jmHari').html());
        $jmRental =0;
        for(let i=0 ; i < parameter.jrental.length; i++){
            $jmRental += parseInt(parameter.jrental[i].harga)
        }
        
        parameter.orang=$jmOrang;
        parameter.hari=$jmHari;

        $total = (parseInt($hgHotel) * $jmHari) + (parseInt($hgResto) * $jmHari) + (parseInt($hgTrans) * $jmOrang)
                 + (parseInt($hgWisata) * $jmOrang) + (parseInt($jmRental)) + parseInt($hgHotelt); 

        $('#hg-total').html('Rp. '+numberWithCommas($total));
        $totalHarga = $total;

        $totalHargaMin = (parseInt($hgHotel) * $jmHari) + (parseInt($hgMin) * $jmHari) + (parseInt($hgTrans) * $jmOrang)
                 + (parseInt($hgWisata) * $jmOrang) + (parseInt($jmRental)) + parseInt($hgHotelt);

        $('#hgMin').html('Rp. '+numberWithCommas($totalHargaMin));
        parameter.hmax=$totalHarga;
        parameter.hmin=$totalHargaMin;
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
        $text = "Minimal : IDR "+numberWithCommas($totalHargaMin)+"\n"+"Maximal : IDR "+numberWithCommas($totalHarga)
                +"\n\n";
        $bebas = $('.alert-login-berhasil').data('flashdata');
        Swal.fire({
            position: 'middle',
            title: 'Total Biaya Estimasi',
            html: '<pre>'+$text+'</pre>',
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Lihat Rincian",
            closeOnConfirm: false
       },
       ).then(val => {
        if (val.isConfirmed) {
        let tojson =JSON.stringify(parameter.jrental);            
        window.open('detail.php?trans='+parameter.transportasi+'&ctrans='+parameter.ctransportasi+'&hotel='+parameter.hotel+'&hoteltransit='+parameter.hoteltransit
                            +'&rumah_makan='+parameter.rumah_makan.join(',')+'&bus='+parameter.bus+'&kelastransit='+parameter.kelastransit
                            +'&wisata='+parameter.wisata.join(',')+'&orang='+parameter.orang+'&hari='+parameter.hari+'&kelas='+parameter.kelas
                            +'&hmax='+parameter.hmax+'&hmin='+parameter.hmin+'&jrental='+tojson);
        }
    });

    });


    $(function () {
        $('#datetimepicker1').datetimepicker();
    });

    $('#tess').click(function(){
        alert($('.hotel').height());
    });


    $(function ($) {
        var options = {
            minimum: 1,
            maximize: 20,
            onChange: valChanged,
            onMinimum: function(e) {
                console.log('reached minimum: '+e)
            },
            onMaximize: function(e) {
                console.log('reached maximize'+e)
            }
        }
        $('#handleCounter').handleCounter(options)
        $('#handleCounter2').handleCounter(options)
    })
    function valChanged(d) {
//            console.log(d)
    }

});
var nav = document.querySelector('nav');

window.addEventListener('scroll', function () {
    if (window.pageYOffset > 250) {
        nav.classList.add('bg-hitam', 'shadow');
    } else {
        nav.classList.remove('bg-hitam', 'shadow');
    }
    
});


// Set up quantity forms
(function(){
  let quantities = document.querySelectorAll('[data-quantity]');

  if (quantities instanceof Node) quantities = [quantities];
  if (quantities instanceof NodeList) quantities = [].slice.call(quantities);
  if (quantities instanceof Array) {
    quantities.forEach(div => (div.quantity = new QuantityInput(div, 'Down', 'Up')));
  }
});

