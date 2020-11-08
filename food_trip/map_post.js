var map;
var infowindow;
var marker;

function initMap() {
    var Lat = 35.7520428459507;
    var Lng = 139.6994434685072;
    var LatLng = new google.maps.LatLng(Lat, Lng); // 中心の緯度、経度
    map = new google.maps.Map(document.getElementById("map_post"), {
        zoom: 10, // ズームの調整
        center: LatLng
    });
    

    // 現在地のボタンを押した時
    document.getElementById('latlng_btn').addEventListener('click', function(){
        window.navigator.geolocation.getCurrentPosition(
            onSuccess
        );
    });
    
    // ピンを立てるボタンを押した時
    document.getElementById('search').addEventListener('click', function(){
        var place = document.getElementById('keyword').value;
        var geocoder = new google.maps.Geocoder();
        
        geocoder.geocode({
            address: place,
            newForwardGeocoder:true
        }, function(results, status){
            if(status == google.maps.GeocoderStatus.OK){
                
                var bounds = new google.maps.LatLngBounds();
                
                for(var i in results){
                    if(results[0].geometry){
                        // 緯度経度取得
                        var latlng = results[0].geometry.location;
                        // 住所を取得
                        var address = results[0].formatted_address;
                        
                        map = new google.maps.Map(document.getElementById('map_post'), {
                            center: latlng,
                            zoom: 17
                        });
                        
                        bounds.extend(latlng);
                        
                        setMarker(latlng);
                        
                        setInfoW(place, latlng, address);
                        
                        markerEvent();
                    }
                }
            } else if(status == google.maps.GeocoderStatus.ZERO_RESULTS){
                alert('見つかりません');
            } else {
                console.log(status);
                alert('エラー発生');
            }
        });
    });
    
    // クリアボタンを押した時
    document.getElementById('clear').addEventListener('click', function(){
        deleteMarkers();
    });
}




// 検索ボタンからマーカーを設置
function setMarker(setplace){
    // すでにあるマーカーの削除
    deleteMarkers();
    
    marker = new google.maps.Marker({
        position: setplace,
        map: map,
        center: setplace,
        zoom: 15,
        animation: google.maps.Animation.DROP
    });
}

// マーカーを削除する
function deleteMarkers(){
    if(marker != null){
        marker.setMap(null);
    }
    marker = null;
}

// マーカーへの吹き出しの追加
function setInfoW(place, latlng, address){
    infowindow = new google.maps.InfoWindow({
        content: "<a href='http://www.google.com/search?q=" + place + "'target='_brank'>" + place + "</a><br><br>" + latlng + "<br><br>" + address + "<br><br><a href='http://www.google.com/search?q=" + place + "&tbm=isch' target='_blank'>画像検索 by google</a>"
    });
}

// マウスをかざした時
function markerEvent(){
    marker.addListener('mouseover', function(){
        infowindow.open(map, marker);
    });
}



// 現在地の取得
function onSuccess(position){
    var target = document.getElementById("map_post");
    var empire = {lat: position.coords.latitude, lng: position.coords.longitude};
    
    map = new google.maps.Map(target, {
      center: empire,
      zoom: 15,
      mapTypeId: 'roadmap'
    });
}

