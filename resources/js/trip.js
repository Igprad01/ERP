document.addEventListener("DOMContentLoaded", () => {
    const inputLokasi = document.getElementById("lokasi");
    const mapWrapper = document.getElementById("map-container");
    const mapElement = document.getElementById("google-map");
    const btnToggleMap = document.getElementById("btn-toggle-map");
    const btnMapLabel = document.getElementById("btn-map-label");
    const btnCurrentLocation = document.getElementById("btn-current-location");
    const suggestionsContainer = document.getElementById(
        "location-suggestions",
    );
    const apiKey = (window.GOOGLE_MAPS_API_KEY || "").trim();

    if (!inputLokasi || !mapElement) return;

    let isMapVisible = false;
    let googleMap = null;
    let googleMarker = null;
    let googleGeocoder = null;
    let leafletMap = null;
    let leafletMarker = null;
    let leafletTileLayer = null;

    // Toggle map visibility
    if (btnToggleMap && mapWrapper) {
        btnToggleMap.addEventListener("click", () => {
            isMapVisible = !isMapVisible;
            if (isMapVisible) {
                mapWrapper.classList.remove("hidden");
                btnMapLabel.textContent = "Tutup Peta";
                initMap();
            } else {
                mapWrapper.classList.add("hidden");
                btnMapLabel.textContent = "Buka Peta";
            }
        });
    }

    // Tombol GPS / Lokasi Saat Ini
    if (btnCurrentLocation) {
        btnCurrentLocation.addEventListener("click", () => {
            if (!navigator.geolocation) {
                alert("Geolocation tidak didukung oleh browser Anda.");
                return;
            }

            btnCurrentLocation.classList.add(
                "opacity-50",
                "pointer-events-none",
            );
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    btnCurrentLocation.classList.remove(
                        "opacity-50",
                        "pointer-events-none",
                    );
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    updateLocationFromCoordinates(lat, lng);
                },
                (error) => {
                    btnCurrentLocation.classList.remove(
                        "opacity-50",
                        "pointer-events-none",
                    );
                    alert(
                        "Gagal mendapatkan lokasi saat ini: " + error.message,
                    );
                },
                { enableHighAccuracy: true },
            );
        });
    }

    // Inisialisasi Peta
    let mapInitialized = false;
    function initMap() {
        if (mapInitialized) {
            if (googleMap) {
                google.maps.event.trigger(googleMap, "resize");
            } else if (leafletMap) {
                leafletMap.invalidateSize();
            }
            return;
        }

        if (apiKey !== "") {
            loadGoogleMaps();
        } else {
            loadLeaflet();
        }
        mapInitialized = true;
    }

    // ----------------------------------------------------
    // MODE TANPA API: LEAFLET & OPENSTREETMAP + NOMINATIM
    // (100% Gratis, Tidak Perlu Registrasi / Kartu Kredit)
    // ----------------------------------------------------
    function loadLeaflet() {
        // Load CSS Leaflet jika belum ada
        if (!document.getElementById("leaflet-css")) {
            const link = document.createElement("link");
            link.id = "leaflet-css";
            link.rel = "stylesheet";
            link.href = "https://unpkg.com/leaflet@1.9.4/dist/leaflet.css";
            document.head.appendChild(link);
        }

        // Load JS Leaflet
        if (window.L) {
            setupLeaflet();
            return;
        }

        const script = document.createElement("script");
        script.src = "https://unpkg.com/leaflet@1.9.4/dist/leaflet.js";
        script.onload = () => setupLeaflet();
        document.head.appendChild(script);
    }

    function setupLeaflet() {
        const defaultLat = -6.2088;
        const defaultLng = 106.8456; // Jakarta

        // Style Dark Mode untuk Leaflet Tile & Controls (Bebas Watermark & 100% Gratis)
        if (!document.getElementById("leaflet-custom-style")) {
            const style = document.createElement("style");
            style.id = "leaflet-custom-style";
            style.textContent = `
                .dark #google-map .leaflet-tile-pane {
                    filter: invert(100%) hue-rotate(180deg) brightness(88%) contrast(92%);
                }
                .dark #google-map.leaflet-container,
                .dark #google-map .leaflet-container {
                    background-color: #0f172a !important;
                }
                .dark #google-map .leaflet-bar a {
                    background-color: #1e293b !important;
                    color: #f1f5f9 !important;
                    border-color: #334155 !important;
                }
                .dark #google-map .leaflet-bar a:hover {
                    background-color: #334155 !important;
                }
                .dark #google-map .leaflet-control-attribution {
                    background-color: rgba(15, 23, 42, 0.8) !important;
                    color: #94a3b8 !important;
                }
                .dark #google-map .leaflet-control-attribution a {
                    color: #60a5fa !important;
                }
                .custom-map-pin {
                    background: transparent;
                    border: none;
                }
            `;
            document.head.appendChild(style);
        }

        leafletMap = L.map(mapElement).setView([defaultLat, defaultLng], 13);
        window.leafletMapInstance = leafletMap;

        // Gunakan OpenStreetMap resmi (100% GRATIS & TANPA WATERMARK)
        leafletTileLayer = L.tileLayer(
            "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            {
                maxZoom: 19,
                attribution:
                    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            },
        ).addTo(leafletMap);

        // Pin marker SVG modern
        const pinIcon = L.divIcon({
            className: "custom-map-pin",
            html: `
                <div style="filter: drop-shadow(0 3px 5px rgba(0,0,0,0.35)); cursor: pointer;">
                    <svg style="width: 34px; height: 34px; color: #ef4444;" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                </div>
            `,
            iconSize: [34, 34],
            iconAnchor: [17, 34],
            popupAnchor: [0, -34],
        });

        leafletMarker = L.marker([defaultLat, defaultLng], {
            draggable: true,
            icon: pinIcon,
        }).addTo(leafletMap);

        // Klik peta untuk pindahkan marker & ambil alamat
        leafletMap.on("click", (e) => {
            leafletMarker.setLatLng(e.latlng);
            reverseGeocodeOSM(e.latlng.lat, e.latlng.lng);
        });

        // Geser marker
        leafletMarker.on("dragend", () => {
            const pos = leafletMarker.getLatLng();
            reverseGeocodeOSM(pos.lat, pos.lng);
        });

        setupNominatimAutocomplete();
    }

    // Reverse Geocoding (Koordinat -> Nama Tempat) tanpa API Key
    function reverseGeocodeOSM(lat, lng) {
        fetch(
            `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`,
        )
            .then((res) => res.json())
            .then((data) => {
                if (data && data.display_name) {
                    inputLokasi.value = data.display_name;
                }
            })
            .catch((err) => console.error("Geocoding error:", err));
    }

    // Autocomplete Dropdown Hasil Pencarian tanpa API Key
    function setupNominatimAutocomplete() {
        if (!suggestionsContainer) return;

        let debounceTimer = null;
        inputLokasi.addEventListener("input", (e) => {
            const query = e.target.value.trim();
            clearTimeout(debounceTimer);

            if (query.length < 3) {
                suggestionsContainer.innerHTML = "";
                suggestionsContainer.classList.add("hidden");
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch(
                    `https://nominatim.openstreetmap.org/search?format=jsonv2&q=${encodeURIComponent(query)}&addressdetails=1&limit=5`,
                )
                    .then((res) => res.json())
                    .then((results) => {
                        renderSuggestions(results);
                    })
                    .catch(() => {
                        suggestionsContainer.classList.add("hidden");
                    });
            }, 350);
        });

        // Tutup dropdown saat klik di luar
        document.addEventListener("click", (e) => {
            if (
                !inputLokasi.contains(e.target) &&
                !suggestionsContainer.contains(e.target)
            ) {
                suggestionsContainer.classList.add("hidden");
            }
        });
    }

    function renderSuggestions(results) {
        if (!suggestionsContainer) return;
        if (!results || results.length === 0) {
            suggestionsContainer.innerHTML = `
                <div class="px-4 py-2.5 text-xs text-gray-500 dark:text-slate-400">
                    Tidak ditemukan lokasi yang sesuai.
                </div>`;
            suggestionsContainer.classList.remove("hidden");
            return;
        }

        let html = "";
        results.forEach((item) => {
            const title = item.name || item.display_name.split(",")[0];
            const address = item.display_name;
            const lat = parseFloat(item.lat);
            const lon = parseFloat(item.lon);

            html += `
                <div class="suggestion-item flex items-start gap-2.5 px-4 py-2 hover:bg-gray-100 dark:hover:bg-slate-800 cursor-pointer transition"
                    data-lat="${lat}" data-lng="${lon}" data-name="${address}">
                    <svg class="h-4 w-4 mt-0.5 shrink-0 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <div class="text-left">
                        <p class="text-xs font-semibold text-gray-900 dark:text-white line-clamp-1">${title}</p>
                        <p class="text-[11px] text-gray-500 dark:text-slate-400 line-clamp-1">${address}</p>
                    </div>
                </div>`;
        });

        suggestionsContainer.innerHTML = html;
        suggestionsContainer.classList.remove("hidden");

        // Event listener klik suggestion item
        const items = suggestionsContainer.querySelectorAll(".suggestion-item");
        items.forEach((elem) => {
            elem.addEventListener("click", () => {
                const lat = parseFloat(elem.getAttribute("data-lat"));
                const lng = parseFloat(elem.getAttribute("data-lng"));
                const name = elem.getAttribute("data-name");

                inputLokasi.value = name;
                suggestionsContainer.classList.add("hidden");

                // Buka peta jika belum terbuka
                if (!isMapVisible && mapWrapper) {
                    mapWrapper.classList.remove("hidden");
                    btnMapLabel.textContent = "Tutup Peta";
                    isMapVisible = true;
                    initMap();
                }

                if (leafletMap && leafletMarker) {
                    leafletMap.setView([lat, lng], 15);
                    leafletMarker.setLatLng([lat, lng]);
                }
            });
        });
    }

    function loadGoogleMaps() {
        if (window.google && window.google.maps) {
            setupGoogleMaps();
            return;
        }

        const script = document.createElement("script");
        script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&libraries=places&loading=async`;
        script.async = true;
        script.defer = true;
        script.onload = () => setupGoogleMaps();
        script.onerror = () => {
            console.warn("Google Maps API gagal dimuat. Beralih ke Leaflet...");
            loadLeaflet();
        };
        document.head.appendChild(script);
    }

    function setupGoogleMaps() {
        const defaultLocation = { lat: -6.2088, lng: 106.8456 };
        googleGeocoder = new google.maps.Geocoder();

        const isDarkMode = document.documentElement.classList.contains("dark");
        const darkMapStyles = [
            { elementType: "geometry", stylers: [{ color: "#242f3e" }] },
            {
                elementType: "labels.text.stroke",
                stylers: [{ color: "#242f3e" }],
            },
            {
                elementType: "labels.text.fill",
                stylers: [{ color: "#746855" }],
            },
            {
                featureType: "road",
                elementType: "geometry",
                stylers: [{ color: "#38414e" }],
            },
            {
                featureType: "water",
                elementType: "geometry",
                stylers: [{ color: "#17263c" }],
            },
        ];

        googleMap = new google.maps.Map(mapElement, {
            center: defaultLocation,
            zoom: 12,
            styles: isDarkMode ? darkMapStyles : [],
            mapTypeControl: false,
            streetViewControl: false,
            fullscreenControl: true,
        });

        googleMarker = new google.maps.Marker({
            position: defaultLocation,
            map: googleMap,
            draggable: true,
            title: "Lokasi Destinasi",
        });

        // Google Places Autocomplete
        const autocomplete = new google.maps.places.Autocomplete(inputLokasi, {
            fields: ["formatted_address", "geometry", "name"],
        });
        autocomplete.bindTo("bounds", googleMap);

        autocomplete.addListener("place_changed", () => {
            const place = autocomplete.getPlace();
            if (!place.geometry || !place.geometry.location) return;

            if (!isMapVisible && mapWrapper) {
                mapWrapper.classList.remove("hidden");
                if (btnMapLabel) btnMapLabel.textContent = "Tutup Peta";
                isMapVisible = true;
            }

            googleMap.setCenter(place.geometry.location);
            googleMap.setZoom(15);
            googleMarker.setPosition(place.geometry.location);

            const locationName = place.name
                ? `${place.name}, ${place.formatted_address || ""}`
                      .replace(/,\s*,/g, ",")
                      .trim()
                : place.formatted_address || inputLokasi.value;

            inputLokasi.value = locationName.replace(/,\s*$/, "");
        });

        googleMap.addListener("click", (e) => {
            googleMarker.setPosition(e.latLng);
            reverseGeocodeGoogle(e.latLng.lat(), e.latLng.lng());
        });

        googleMarker.addListener("dragend", () => {
            const pos = googleMarker.getPosition();
            reverseGeocodeGoogle(pos.lat(), pos.lng());
        });
    }

    function reverseGeocodeGoogle(lat, lng) {
        if (!googleGeocoder) return;
        googleGeocoder.geocode(
            { location: { lat, lng } },
            (results, status) => {
                if (status === "OK" && results && results[0]) {
                    inputLokasi.value = results[0].formatted_address;
                }
            },
        );
    }

    // Update lokasi dari koordinat (GPS)
    function updateLocationFromCoordinates(lat, lng) {
        if (!isMapVisible && mapWrapper) {
            mapWrapper.classList.remove("hidden");
            if (btnMapLabel) btnMapLabel.textContent = "Tutup Peta";
            isMapVisible = true;
            initMap();
        }

        if (googleMap && googleMarker) {
            const pos = new google.maps.LatLng(lat, lng);
            googleMap.setCenter(pos);
            googleMap.setZoom(15);
            googleMarker.setPosition(pos);
            reverseGeocodeGoogle(lat, lng);
        } else if (leafletMap && leafletMarker) {
            leafletMap.setView([lat, lng], 15);
            leafletMarker.setLatLng([lat, lng]);
            reverseGeocodeOSM(lat, lng);
        }
    }
});
