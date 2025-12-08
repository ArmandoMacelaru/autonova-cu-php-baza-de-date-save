// js/app.js - Fișierul principal JavaScript pentru AutoNova

class AutoNovaApp {
    constructor() {
        this.cars = this.loadCars();
        this.currentUser = this.getCurrentUser();
        this.init();
    }

    init() {
        this.updateNavigation();
        this.attachEventListeners();
        this.displayCars(this.cars);
        console.log('AutoNova app initialized! 🚗');
    }

    // === DATELE PENTRU MAȘINI ===
    loadCars() {
        // Încarcă mașinile din localStorage sau folosește datele default
        const savedCars = localStorage.getItem('autonova_cars');
        if (savedCars) {
            return JSON.parse(savedCars);
        }

        // Datele inițiale pentru mașini
        const initialCars = [
            {
                id: 1,
                make: "Volvo",
                model: "XC60 B5 Ultimate",
                year: 2023,
                price: 49900,
                fuel: "hibrid",
                transmission: "automat",
                mileage: 12500,
                color: "Dark",
                seller: "Dealer autorizat Volvo",
                image: "https://apruhonice.s3.eu-central-1.amazonaws.com/87/8787338a-6a56-49be-9f0e-3c9222028ba1.full.jpg",
                badge: "ULTIMUL MODEL",
                detailsPage: "volvo-xc60.html"
            },
            {
                id: 2,
                make: "Skoda",
                model: "Superb 2.0 TDI",
                year: 2016,
                price: 8500,
                fuel: "motorina",
                transmission: "automat",
                mileage: 258000,
                color: "Gri Metalizat",
                seller: "Dealer auto",
                image: "https://media.discordapp.net/attachments/914645674677661736/1441093466984681573/20250702_205622.jpg?ex=692527a0&is=6923d620&hm=2a96e89d07b680c796c5936ba226b4998bd4f8b13afd1e85dee5af63df2558d9&=&format=webp&width=1366&height=769",
                badge: "PREMIUM",
                detailsPage: "skoda-superb.html"
            },
            {
                id: 3,
                make: "BMW",
                model: "Seria 3 320d",
                year: 2021,
                price: 28500,
                fuel: "motorina",
                transmission: "automat",
                mileage: 42100,
                color: "Alb",
                seller: "Dealer auto",
                image: "https://images.unsplash.com/photo-1555215695-3004980ad54e?w=400&h=250&fit=crop",
                badge: "NOU",
                detailsPage: "detalii-bmw.html"
            },
            {
                id: 4,
                make: "Skoda",
                model: "Karoq 1.5 TSI",
                year: 2020,
                price: 14999,
                fuel: "benzina",
                transmission: "automat",
                mileage: 56300,
                color: "Roșu",
                seller: "Vânzător individual",
                image: "https://ireland.apollo.olxcdn.com/v1/files/5p4k6ec367yn-AUTOVITRO/image;s=644x461",
                badge: "REDUS",
                detailsPage: "detalii-skoda.html"
            },
            {
                id: 5,
                make: "Volkswagen",
                model: "Golf 1.6 TDI",
                year: 2019,
                price: 8750,
                fuel: "motorina",
                transmission: "manual",
                mileage: 78400,
                color: "Negru",
                seller: "Vânzător individual",
                image: "https://frankfurt.apollo.olxcdn.com/v1/files/e1yctu2lsgfj3-RO/image;s=1000x750",
                badge: "",
                detailsPage: "detalii-volkswagen.html"
            },
            {
                id: 6,
                make: "Audi",
                model: "A4 2.0 TDI",
                year: 2022,
                price: 6999,
                fuel: "motorina",
                transmission: "automat",
                mileage: 23200,
                color: "Alb",
                seller: "Dealer auto",
                image: "https://frankfurt.apollo.olxcdn.com/v1/files/n9lp0u53l2h12-RO/image;s=2000x1500",
                badge: "PREMIUM",
                detailsPage: "detalii-audi.html"
            },
            {
                id: 7,
                make: "Dacia",
                model: "Duster 1.5 dCi",
                year: 2021,
                price: 18300,
                fuel: "motorina",
                transmission: "manual",
                mileage: 45600,
                color: "Alb",
                seller: "Vânzător individual",
                image: "https://images.unsplash.com/photo-1601362840469-51e4d8d58785?w=400&h=250&fit=crop",
                badge: "",
                detailsPage: "detalii-dacia.html"
            },
            {
                id: 8,
                make: "Mercedes",
                model: "C-Class C200",
                year: 2022,
                price: 35800,
                fuel: "benzina",
                transmission: "automat",
                mileage: 18900,
                color: "Negru",
                seller: "Dealer auto",
                image: "https://images.unsplash.com/photo-1563720223485-8f6a4bca015c?w=400&h=250&fit=crop",
                badge: "NOU",
                detailsPage: "detalii-mercedes.html"
            }
        ];

        // Salvează în localStorage pentru prima dată
        this.saveCars(initialCars);
        return initialCars;
    }

    saveCars(cars) {
        localStorage.setItem('autonova_cars', JSON.stringify(cars));
    }

    // === SISTEM UTILIZATOR ===
    getCurrentUser() {
        return JSON.parse(localStorage.getItem('autonova_current_user'));
    }

    isLoggedIn() {
        return this.getCurrentUser() !== null;
    }

    updateNavigation() {
        const loginLink = document.getElementById('loginLink');
        if (loginLink && this.isLoggedIn()) {
            const user = this.getCurrentUser();
            loginLink.innerHTML = `Bună, ${user.username} | <a href="logout.html" style="color: white; text-decoration: none;">Logout</a>`;
        }
    }

    // === AFIȘAREA MAȘINILOR ===
    displayCars(cars) {
        const grid = document.getElementById('carsGrid');
        if (!grid) return;

        grid.innerHTML = '';

        cars.forEach(car => {
            const carCard = this.createCarCard(car);
            grid.innerHTML += carCard;
        });

        this.attachCarEvents();
    }

    createCarCard(car) {
        return `
            <div class="car-card" data-car-id="${car.id}">
                ${car.badge ? `<div class="car-badge">${car.badge}</div>` : ''}
                <div class="car-image">
                    <img src="${car.image}" alt="${car.make} ${car.model}" loading="lazy">
                    <button class="favorite-btn">♥</button>
                </div>
                <div class="car-content">
                    <h3 class="car-title">${car.make} ${car.model}</h3>
                    <p class="car-seller">${car.seller}</p>
                    <div class="car-details">
                        <div class="car-detail">📅 ${car.year}</div>
                        <div class="car-detail">🛣️ ${car.mileage.toLocaleString()} km</div>
                        <div class="car-detail">⛽ ${this.getFuelName(car.fuel)}</div>
                        <div class="car-detail">⚙️ ${this.getTransmissionName(car.transmission)}</div>
                    </div>
                    <div class="car-price">${car.price.toLocaleString()} €</div>
                    <div class="car-actions">
                        <a href="${car.detailsPage}" class="details-btn">Vezi detalii</a>
                        <button class="compare-btn" data-car-id="${car.id}">Compară</button>
                    </div>
                </div>
            </div>
        `;
    }

    getFuelName(fuel) {
        const fuelNames = {
            'benzina': 'Benzină',
            'motorina': 'Motorină',
            'gpl': 'GPL',
            'hibrid': 'Hibrid',
            'electric': 'Electric'
        };
        return fuelNames[fuel] || fuel;
    }

    getTransmissionName(transmission) {
        const transmissionNames = {
            'manual': 'Manuală',
            'automat': 'Automată'
        };
        return transmissionNames[transmission] || transmission;
    }

    // === EVENT LISTENERS ===
    attachEventListeners() {
        this.attachSearch();
        this.attachFilters();
        this.attachFavoriteButtons();
        this.attachCompareButtons();
        this.attachAddCarForm();
    }

    attachCarEvents() {
        this.attachFavoriteButtons();
        this.attachCompareButtons();
    }

    attachSearch() {
        const searchInput = document.querySelector('.search-box input');
        const searchBtn = document.querySelector('.search-btn');

        if (searchBtn && searchInput) {
            searchBtn.addEventListener('click', () => this.performSearch());
            searchInput.addEventListener('input', () => {
                if (searchInput.value === '') {
                    this.displayCars(this.cars);
                }
            });
            searchInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    this.performSearch();
                }
            });
        }
    }

    performSearch() {
        const searchInput = document.querySelector('.search-box input');
        const searchTerm = searchInput.value.toLowerCase().trim();
        
        if (searchTerm === '') {
            this.displayCars(this.cars);
            return;
        }

        const filteredCars = this.cars.filter(car => {
            const searchText = `${car.make} ${car.model} ${car.year} ${car.fuel} ${car.transmission} ${car.color}`.toLowerCase();
            return searchText.includes(searchTerm);
        });

        this.displayCars(filteredCars);
    }

    attachFilters() {
        const filterSelects = document.querySelectorAll('.filter-select');
        filterSelects.forEach(select => {
            select.addEventListener('change', () => this.applyFilters());
        });
    }

    applyFilters() {
        // Implementare filtre avansate poate fi adăugată aici
        console.log('Aplicare filtre...');
    }

    attachFavoriteButtons() {
        const favoriteBtns = document.querySelectorAll('.favorite-btn');
        favoriteBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                this.classList.toggle('active');
                this.style.color = this.classList.contains('active') ? 'red' : 'gray';
                
                // Salvează în favorite
                const carCard = this.closest('.car-card');
                const carId = carCard.dataset.carId;
                app.toggleFavorite(carId);
            });
        });
    }

    attachCompareButtons() {
        const compareBtns = document.querySelectorAll('.compare-btn');
        compareBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const carId = this.dataset.carId;
                app.addToCompare(carId);
            });
        });
    }

    attachAddCarForm() {
        const addCarBtn = document.getElementById('addCarBtn');
        const addCarSection = document.getElementById('addCarSection');
        const cancelBtn = document.getElementById('cancelBtn');
        const addCarForm = document.getElementById('add-car-form');

        if (addCarBtn && addCarSection) {
            addCarBtn.addEventListener('click', (e) => {
                e.preventDefault();
                if (!this.isLoggedIn()) {
                    alert('Trebuie să fii logat pentru a adăuga o mașină!');
                    window.location.href = 'login.html';
                    return;
                }
                addCarSection.classList.add('active');
                window.scrollTo({ top: addCarSection.offsetTop - 100, behavior: 'smooth' });
            });
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => {
                addCarSection.classList.remove('active');
                addCarForm.reset();
            });
        }

        if (addCarForm) {
            addCarForm.addEventListener('submit', (e) => this.handleAddCarForm(e));
        }
    }

    // === FUNCȚIONALITĂȚI AVANSATE ===
    toggleFavorite(carId) {
        let favorites = JSON.parse(localStorage.getItem('autonova_favorites') || '[]');
        
        if (favorites.includes(carId)) {
            favorites = favorites.filter(id => id !== carId);
        } else {
            favorites.push(carId);
        }
        
        localStorage.setItem('autonova_favorites', JSON.stringify(favorites));
        console.log('Favorite updated:', favorites);
    }

    addToCompare(carId) {
        let compareList = JSON.parse(localStorage.getItem('autonova_compare') || '[]');
        
        if (compareList.includes(carId)) {
            alert('Această mașină este deja în lista de comparare!');
            return;
        }

        if (compareList.length >= 3) {
            alert('Poți compara maximum 3 mașini!');
            return;
        }

        compareList.push(carId);
        localStorage.setItem('autonova_compare', JSON.stringify(compareList));
        
        const car = this.cars.find(c => c.id == carId);
        alert(`${car.make} ${car.model} a fost adăugată la comparație!`);
    }

    handleAddCarForm(e) {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const carData = {
            id: Date.now(),
            make: formData.get('make') || document.getElementById('make').value,
            model: formData.get('model') || document.getElementById('model').value,
            year: parseInt(formData.get('year') || document.getElementById('year').value),
            price: parseInt(formData.get('price') || document.getElementById('price').value),
            fuel: formData.get('fuel') || document.getElementById('fuel').value,
            transmission: formData.get('transmission') || document.getElementById('transmission').value,
            mileage: parseInt(formData.get('mileage') || document.getElementById('mileage').value),
            color: formData.get('color') || document.getElementById('color').value,
            description: formData.get('description') || document.getElementById('description').value,
            images: (formData.get('images') || document.getElementById('images').value).split(',').map(url => url.trim()),
            contact: formData.get('contact') || document.getElementById('contact').value,
            seller: this.isLoggedIn() ? this.getCurrentUser().username : "Vânzător individual",
            image: "https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=400&h=250&fit=crop", // imagine default
            badge: "NOU",
            detailsPage: `car-${Date.now()}.html`,
            date: new Date().toISOString()
        };

        // Adaugă mașina nouă
        this.cars.unshift(carData);
        this.saveCars(this.cars);
        
        // Reafișează mașinile
        this.displayCars(this.cars);
        
        // Afișează mesaj de succes
        alert('Mașina a fost adăugată cu succes! 🎉');
        
        // Resetează și ascunde formularul
        e.target.reset();
        document.getElementById('addCarSection').classList.remove('active');
    }

    // === UTILITARE ===
    getCarById(carId) {
        return this.cars.find(car => car.id == carId);
    }

    getCarsByMake(make) {
        return this.cars.filter(car => car.make.toLowerCase() === make.toLowerCase());
    }

    getCarsByPriceRange(minPrice, maxPrice) {
        return this.cars.filter(car => car.price >= minPrice && car.price <= maxPrice);
    }
}

// Initializează aplicația când DOM-ul este gata
document.addEventListener('DOMContentLoaded', function() {
    window.app = new AutoNovaApp();
});

// Export pentru module (dacă este necesar)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = AutoNovaApp;
}

