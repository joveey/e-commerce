<!-- Rating Success Modal -->
<div x-data="{ 
    showRatingModal: false,
    orderItems: [],
    currentItemIndex: 0,
    rating: 0,
    review: '',
    isLastItem: false
}"
x-init="() => {
    // Check for rating session data
    const ratingData = {{ json_encode(session('rating_items') ?? []) }};
    if (ratingData.length > 0) {
        orderItems = ratingData;
        showRatingModal = true;
    }
}"
x-show="showRatingModal"
class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
style="display: none;">
    
    <div class="bg-white rounded-xl max-w-md w-full p-6 m-4" @click.away="showRatingModal = false">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-star text-pink-500 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-1">Bagaimana dengan produk ini?</h3>
            <p class="text-gray-600" x-text="'Produk ' + (currentItemIndex + 1) + ' dari ' + orderItems.length"></p>
        </div>

        <!-- Product Info -->
        <template x-if="orderItems.length > 0">
            <div class="flex items-center space-x-4 mb-6 bg-gray-50 p-4 rounded-lg">
                <img :src="'/storage/' + orderItems[currentItemIndex].image" 
                     :alt="orderItems[currentItemIndex].name"
                     class="w-16 h-16 object-cover rounded">
                <div>
                    <h4 class="font-medium text-gray-900" x-text="orderItems[currentItemIndex].name"></h4>
                    <p class="text-sm text-gray-500" x-text="'Quantity: ' + orderItems[currentItemIndex].quantity"></p>
                </div>
            </div>
        </template>

        <form @submit.prevent="submitRating()">
            <!-- Star Rating -->
            <div class="flex items-center justify-center space-x-2 mb-6">
                <template x-for="star in 5" :key="star">
                    <button type="button"
                        @click="rating = star"
                        class="focus:outline-none transform transition hover:scale-110"
                        :class="star <= rating ? 'text-yellow-400' : 'text-gray-300'">
                        <i class="fas fa-star text-3xl"></i>
                    </button>
                </template>
            </div>

            <!-- Review Text -->
            <div class="mb-6">
                <textarea
                    x-model="review"
                    class="w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring focus:ring-pink-200"
                    rows="3"
                    placeholder="Bagikan pengalaman Anda dengan produk ini... (Opsional)"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between">
                <button type="button"
                    @click="showRatingModal = false"
                    class="px-4 py-2 text-gray-600 hover:text-gray-700">
                    Nanti Saja
                </button>
                <button type="submit"
                    :disabled="rating === 0"
                    class="bg-pink-600 text-white px-6 py-2 rounded-lg hover:bg-pink-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    Kirim Rating
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function submitRating() {
    const currentItem = this.orderItems[this.currentItemIndex];
    
    fetch("{{ route('products.rate') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            order_id: currentItem.order_id,
            product_id: currentItem.product_id,
            rating: this.rating,
            review: this.review
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            this.currentItemIndex++;
            this.rating = 0;
            this.review = '';
            
            if (this.currentItemIndex >= this.orderItems.length) {
                this.showRatingModal = false;
                // Clear the session
                fetch("{{ route('products.clearRatingSession') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
            }
        }
    });
}
