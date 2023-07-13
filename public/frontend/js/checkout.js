$(document).ready(function (){
    $('.razorpay_btn').click(function (e) {
        e.preventDefault();

        var firstname = $('.firstname').val();
        var lastname = $('.lastname').val();
        var email = $('.email').val();
        var no_telp = $('.no_telp').val(); 
        var alamat = $('.alamat').val();
        var kota = $('.kota').val();
        var provinsi = $('.provinsi').val();
        var negara = $('.negara').val();
        var kode_pos = $('.kode_pos').val();

        //isi form kosong
        if(!firstname){
            fname_error = "Nama Depan Tidak Boleh Kosong";
            $('#fname_error').html('');
            $('#fname_error').html(fname_error);
        } else{
            fname_error = "";
            $('#fname_error').html('');
        }

        if(!lastname){
            lname_error = "Nama Belakang Tidak Boleh Kosong";
            $('#lname_error').html('');
            $('#lname_error').html(lname_error);
        } else{
            lname_error = "";
            $('#lname_error').html('');
        }
        
        if(!email){
            email_error = "Email Tidak Boleh Kosong";
            $('#email_error').html('');
            $('#email_error').html(email_error);
        } else{
            email_error = "";
            $('#email_error').html('');
        }
        
        if(!no_telp){
            no_telp_error = "No. Telp Tidak Boleh Kosong";
            $('#no_telp_error').html('');
            $('#no_telp_error').html(no_telp_error);
        } else{
            no_telp_error = "";
            $('#no_telp_error').html('');
        }
        
        if(!alamat){
            alamat_error = "Alamat Tidak Boleh Kosong";
            $('#alamat_error').html('');
            $('#alamat_error').html(alamat_error);
        } else{
            alamat_error = "";
            $('#alamat_error').html('');
        }
        
        if(!kota){
            kota_error = "Kota Tidak Boleh Kosong";
            $('#kota_error').html('');
            $('#kota_error').html(kota_error);
        } else{
            kota_error = "";
            $('#kota_error').html('');
        }
        
        if(!provinsi){
            provinsi_error = "Provinsi Tidak Boleh Kosong";
            $('#provinsi_error').html('');
            $('#provinsi_error').html(provinsi_error);
        } else{
            provinsi_error = "";
            $('#provinsi_error').html('');
        }
        
        if(!negara){
            negara_error = "Negara Tidak Boleh Kosong";
            $('#negara_error').html('');
            $('#negara_error').html(negara_error);
        } else{
            negara_error = "";
            $('#negara_error').html('');
        }
        
        if(!kode_pos){
            kode_pos_error = "Kode Pos Tidak Boleh Kosong";
            $('#kode_pos_error').html('');
            $('#kode_pos_error').html(kode_pos_error);
        } else{
            kode_pos_error = "";
            $('#kode_pos_error').html('');
        }
        
        if(fname_error != '' || lname_error != '' || email_error != '' || no_telp_error != '' || alamat_error != '' || kota_error != '' || provinsi_error != '' || negara_error != '' || kode_pos_error != ''){
            return false;
        } else{
            var data ={ 
                    'firstname': firstname,
                    'lastname': lastname,
                    'email': email,
                    'no_telp': no_telp,
                    'alamat': alamat,
                    'kota': kota,
                    'provinsi': provinsi,
                    'negara': negara,
                    'kode_pos': kode_pos,
            }
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "/proceed-pay",
                dataType: "json",
                data: data,
                success: function(response){
                    // alert(response.total);
                    var options = {
                        "key": "rzp_test_ZX2LPI1OcBH7AR", // Key API Payment Razor
                        "amount": 1*100, // Jumlah uang
                        "currency": "INR",
                        "name": response.firstname+' '+response.lastname, //nama pelanggan
                        "description": "Terimakasih telah memilih kami..",
                        "image": "assets/document/logo.png",
                        // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        "handler": function (responsea){
                            // alert(responsea.razorpay_payment_id);
                            $.ajax({
                                method: "POST",
                                url: "/place-order",
                                data: {
                                    'fname':response.firstname,
                                    'lname':response.lastname,
                                    'email':response.email,
                                    'no_telp':response.no_telp,
                                    'alamat':response.alamat,
                                    'kota':response.kota,
                                    'provinsi':response.provinsi,
                                    'negara':response.negara,
                                    'kode_pos':response.kode_pos,
                                    'payment_mode':"Pembayaran melalui Payment",
                                    'payment_id':responsea.razorpay_payment_id,
                                },
                                success: function(responseb){
                                    swal("", responseb.status, "success");
                                    window.location.href = "/";
                                }
                            });
                        },
                        "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information, especially their phone number
                            "name": response.firstname+' '+response.lastname, //Nama Customer
                            "email": response.email, 
                            "contact": response.no_telp  //Provide the customer's phone number for better conversion rates 
                        },
                        "theme": {
                            "color": "#FFA500"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                }
            });
        }
    });
});
