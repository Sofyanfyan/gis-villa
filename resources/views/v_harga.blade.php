@extends('layouts.frontend')
@section('content')

<div id="map" style="width: 100%; height: 500px;"></div>

<div class="col-sm-12">
    <br>
    <br>
    <div class="text-center"><h2><b>Data Villa {{ $title }}</b></h2></div>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50px" class="text-center">No</th>
                <th class="text-center">Nama Villa</th>
                <th width="50px" class="text-center">Harga</th>
                <th class="text-center">untuk</th>
                <th class="text-center">Coordinat</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            @foreach ($villa as $data)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $data->nama_villa }}</td>
                    <td>{{ $data->harga }}</td>
                    <td>{{ $data->untuk }}</td>
                    <td>{{ $data->posisi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>

    var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11'
        });

    var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/satellite-v9'
        });


    var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

    var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/dark-v10'
	});
    
    var map = L.map('map', {
    center: [-7.882791998768492, 112.53318294269594],
    zoom: 12,
    layers: [peta2]
    });
    
    var baseMaps = {
    "Grayscale": peta1,
    "Satellite": peta2,
    "Streets": peta3,
    "Dark": peta4,
    };

    L.control.layers(baseMaps).addTo(map);

    @foreach ($kecamatan as $data)
        L.geoJSON(<?= $data->geojson ?>,{
            style : {
                color : 'brown',
                fillColor : '{{ $data->warna }}',
                fillOpacity : 1.0,     
            },
        }).addTo(map);
    @endforeach

    @foreach ($villa as $data)
    var iconvilla = L.icon({
    iconUrl: '{{ asset('icon') }}/{{ $data->icon }}',
    iconSize:     [50, 70], // size of the icon
});
    var informasi = '<table class="table table-bordered"><tr><th></th colspan="2"><th><img src="{{ asset('foto') }}/{{ $data->foto }}" width="220px"></th></tr><tbody><tr><td>Nama Villa</td><td>: {{ $data->nama_villa }}</td></tr><tr><td>Harga</td><td>: {{ $data->harga_villa }}</td></tr><tr><td>Untuk</td><td>: {{ $data->untuk }}</td></tr><tr><td colspan="2" class="text-center"><a href="/detailvilla/{{ $data->id_villa }}" class="btn btn-sm btn-default">Detail</a></td></tr></tbody></table>';

    L.marker([<?= $data->posisi ?>],{icon:iconvilla})
    .addTo(map)
    .bindPopup(informasi);
    @endforeach

    @foreach ($villa as $data)
    var iconvilla = L.icon({
    iconUrl: '{{ asset('icon') }}/{{ $data->icon }}',
    iconSize:     [50, 70], // size of the icon
});
var informasi = '<table class="table table-bordered"><tr><th></th colspan="2"><th><img src="{{ asset('foto') }}/{{ $data->foto }}" width="220px"></th></tr><tbody><tr><td>Nama Villa</td><td>: {{ $data->nama_villa }}</td></tr><tr><td>Harga</td><td>: {{ $data->harga_villa }}</td></tr><tr><td>Untuk</td><td>: {{ $data->untuk }}</td></tr><tr><td colspan="2" class="text-center"><a href="/detailvilla/{{ $data->id_villa }}" class="btn btn-sm btn-default">Detail</a></td></tr></tbody></table>';
        L.marker([{{ $data->posisi }}],{icon:iconvilla})
        .addTo(map)
        .bindPopup(informasi);
    @endforeach

</script>
@endsection