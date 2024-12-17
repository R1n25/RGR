document.addEventListener('DOMContentLoaded', function() {
    const cart = {
        items: JSON.parse(localStorage.getItem('cart') || '[]'),
        
        addItem(part) {
            this.items.push(part);
            this.updateCart();
            this.saveToStorage();
        },
        
        removeItem(partId) {
            this.items = this.items.filter(item => item.id !== partId);
            this.updateCart();
            this.saveToStorage();
        },
        
        updateCart() {
            const cartCount = document.querySelector('.cart-count');
            if (cartCount) {
                cartCount.textContent = this.items.length;
            }
        },
        
        saveToStorage() {
            localStorage.setItem('cart', JSON.stringify(this.items));
        }
    };

    // Инициализация корзины
    cart.updateCart();

    // Обработчики добавления в корзину
    document.querySelectorAll('.btn-add-cart').forEach(button => {
        button.addEventListener('click', function() {
            const partId = this.dataset.id;
            const card = this.closest('.part-card');
            const part = {
                id: partId,
                name: card.querySelector('h3').textContent,
                price: parseFloat(card.querySelector('.price').textContent),
                image: card.querySelector('img').src
            };
            
            cart.addItem(part);
            
            // Анимация добавления
            this.textContent = 'Добавлено ✓';
            this.style.background = '#28a745';
            setTimeout(() => {
                this.textContent = 'В корзину';
                this.style.background = '';
            }, 1000);
        });
    });

    // Фильтры
    const filterForm = document.querySelector('.filters form');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const params = new URLSearchParams(formData);
            window.location.href = `${this.action}?${params.toString()}`;
        });
    }
}); 