@extends('layouts.app')
@section('title','index')
@push('style')
@endpush
@section('content')
    <div class="jumbotron text-center ">
    <h1>Data Terkini Covid 19 dari Seluruh Dunia</h1>
    <p>Coronavirus Global & Indonesia Live Data</p> 
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card bg-danger img-card box-primary-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <p class="text-white mb-0">TOTAL POSITIF</p>
                                <h2 class="mb-0 number-font" id="tot_positif">0</h2>
                                <p class="text-white mb-0">ORANG</p>
                            </div>
                            <div class="ml-auto"> <img src="../uploads/sad-u6e.png" width="50" height="50" alt="Positif"> </div>
                        </div>
                    </div>
                </div>
            </div><!-- COL END -->
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card bg-success img-card box-secondary-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <p class="text-white mb-0">TOTAL SEMBUH</p>
                                <h2 class="mb-0 number-font" id="tot_sembuh">0</h2>
                                <p class="text-white mb-0">ORANG</p>
                            </div>
                            <div class="ml-auto"> <img src="../uploads/happy-ipM.png" width="50" height="50" alt="Positif"> </div>
                        </div>
                    </div>
                </div>
            </div><!-- COL END -->
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card  bg-secondary img-card box-success-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <p class="text-white mb-0">TOTAL MENINGGAL</p>
                                <h2 class="mb-0 number-font" id="tot_meninggal">0</h2>
                                <p class="text-white mb-0">ORANG</p>
                            </div>
                            <div class="ml-auto"> <img src="../uploads/emoji-LWx.png" width="50" height="50" alt="Positif"> </div>
                        </div>
                    </div>
                </div>
            </div><!-- COL END -->
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card  bg-danger img-card box-success-shadow">
                    <a class ="card-link" href="#" data-toggle="tooltip" data-placement="top" title="Detail Data Indonesia">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white" id="indonesia">
                                <p id="inaloading">
                                    <div class="d-flex justify-content-center">
                                        <div class="spinner-grow text-info " role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </p>
                            </div>
                            <div class="ml-auto"> <img src="../uploads/indonesia-PZq.png" width="50" height="50" alt="Positif"> </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div><!-- COL END -->
            <!-- <div class="col text-center"><p>Sumber data : Kementerian Kesehatan & JHU. Update terakhir : 30  Maret 2020 22:55:44 WIB</p></div> -->
        </div>
    </div>

    <section id="table">
        <div class="container mt-5  ">
        <h2>Data Sebaran Covid-19 Dunia</h2>
        <p>Data yang terkonfirmasi di Dunia</p>            
        <table class="table">
            <thead>
            <tr>
                <th>No</th>
                <th>Negara</th>
                <th>Positif</th>
                <th>Meninggal</th>
                <th>Sembuh</th>
                <th>Aktif</th>
                <th>Update Terakhir</th>
            </tr>
            </thead>
            <tbody id="data">
            <tr>
                <td colspan="7" id="loading" style="display:show">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-grow text-info " role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        </div>
    </section>
@endsection

@push('script')
<script>
    // Main Code
    get_some(0,5);
    get_indonesia();
    get_go_positif();
    get_go_sembuh();
    get_go_meninggal();


    // Function
    function get_some(from,to){
        $("#data").html(`
        <tr>
            <td colspan="7" id="loading">
                <div class="d-flex justify-content-center">
                    <div class="spinner-grow text-info " role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </td>
        </tr> 
        `);
        var data = '';
        axios.get('https://api.kawalcorona.com/')
        .then((response) => {
            document.getElementById("loading").style.display = "none";
            data = response.data;
            data.slice(from,to).forEach(show_data);
            $('#data').append(`
                <tr id="loadmore">
                    <td colspan="7">
                        <div class="d-flex justify-content-center">
                                <a href="#table" class="btn btn-primary" onclick="return get_all(`+to+`)" > Load More </a>
                        </div>
                    </td>
                </tr>
            `);
        }, (error) => {
            console.log(error);
        });
    }
    function get_all(from){
        $("#data").html(`
        <tr>
            <td colspan="7" id="loading">
                <div class="d-flex justify-content-center">
                    <div class="spinner-grow text-info " role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </td>
        </tr> 
        `);
        var data = '';
        axios.get('https://api.kawalcorona.com/')
        .then((response) => {
            document.getElementById("loading").style.display = "none";
            data = response.data;
            length = response.data.length;
            data.forEach(show_data);
            $('#data').append(`
                <tr id="loadmore">
                    <td colspan="7">
                        <div class="d-flex justify-content-center">
                                <a href="#table" class="btn btn-primary" onclick="return get_some(0,5)" > show Less </a>
                        </div>
                    </td>
                </tr>
            `);
        }, (error) => {
            console.log(error);
        });
    }
    function show_data(item, index) {
        var no=index+1;
        var date = new Date(item.attributes['Last_Update']);
        var dateString = date.toGMTString();
        $("#data").append(`
        <tr>
            <td>`+no+`</td>
            <td>`+item.attributes['Country_Region']+`</td>
            <td>`+item.attributes['Confirmed'].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')+`</td>
            <td>`+item.attributes['Deaths'].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')+`</td>
            <td>`+item.attributes['Recovered'].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')+`</td>
            <td>`+item.attributes['Active'].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')+`</td>
            <td>`+dateString+`</td>
        </tr>
        `); 
    }
    function get_indonesia(){
        var data = '';
        axios.get('https://api.kawalcorona.com/indonesia/')
        .then((response) => {
            document.getElementById("inaloading").style.display="none";
            data = response.data;
            $('#indonesia').html(`
                <p class="text-white mb-0">INDONESIA</p>
                <font size="2.5">
                    <p class="text-white mb-0">POSITIF <b> `+data[0].positif+`</b> ,</p>
                    <p class="text-white mb-0"> SEMBUH <b>`+data[0].sembuh+`</b> , </p>
                    <p class="text-white mb-0"> MENINGGAL <b>`+data[0].meninggal+`</b> </p>
                </font>
            `);
        }, (error) => {
            console.log(error);
        });
    }
    function get_go_positif(){
        
        var data = '';
        axios.get('https://api.kawalcorona.com/positif/')
        .then((response) => {
            data = response.data;
            $('#tot_positif').html(data.value);
        }, (error) => {
            console.log(error);
        });
    }
    function get_go_sembuh(){
        
        var data = '';
        axios.get('https://api.kawalcorona.com/sembuh/')
        .then((response) => {
            data = response.data;
            $('#tot_sembuh').html(data.value);
        }, (error) => {
            console.log(error);
        });
    }
    function get_go_meninggal(){
        var data = '';
        axios.get('https://api.kawalcorona.com/meninggal/')
        .then((response) => {
            data = response.data;
            $('#tot_meninggal').html(data.value);
        }, (error) => {
            console.log(error);
        });
    }
    

</script>

@endpush