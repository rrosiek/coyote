<template>
    <div class="map" id="map"></div>
</template>

<script>
import jsonp from 'jsonp'

export default {
    computed: {
    },
    data () {
        return {
            localLat: 44.6696807,
            localLng: -75.0049451,
            map: null,
            markerCluster: null,
            markers: []
        }
    },
    methods: {
        fetchLocation () {
            return new Promise(resolve => {
                jsonp('https://freegeoip.net/json', null, (err, data) => {
                    if (err) {
                        console.log('Error getting freegeoip data, using defaults...')
                    } else {
                        this.localLat = data.latitude
                        this.localLng = data.longitude
                    }

                    resolve('OK')
                })
            })
        },
        fetchMarkers () {
            return new Promise(resolve => {
                // TODO: limit markers based on zoom level / location
                this.$http.get('/members/profiles').then(resp => {
                    this.markers = resp.data.map(user => {
                        let marker = new google.maps.Marker({
                            position: { 'lat': user.latitude, 'lng': user.longitude }
                        })

                        marker.addListener('click', () => {
                            this.openInfo(marker, user)
                        })

                        return marker
                    })

                    resolve('OK')
                })
            })
        },
        initMap () {
            this.map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                center: {lat: this.localLat, lng: this.localLng}
            })
        },
        openInfo (marker, user) {
            this.$http.get('/members/profiles/' + user.id).then(resp => {
                let infowindow = new google.maps.InfoWindow({
                    content: `
                        <article class="media">
                            <div class="media-left">
                                <figure class="image is-64x64">
                                    <img src="${resp.data.avatar_url}" alt="Avatar">
                                </figure>
                            </div>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>${resp.data.name}</strong>, ${resp.data.grad_year}
                                        <br>${resp.data.email}
                                        <br>${resp.data.full_address}
                                        <br>Phone: ${resp.data.phone}
                                        <br>Employer: ${resp.data.employer}
                                    </p>
                                </div>
                            </div>
                    </article>`
                })

                infowindow.open(this.map, marker)
            })
        }
    },
    mounted () {
        this.fetchMarkers().then(() => {
            this.initMap()
            this.markerCluster = new MarkerClusterer(
                this.map,
                this.markers,
                { imagePath: '/images/m' }
            )
        })
    },
    name: 'MemberMap'
}
</script>
