<!-- Rating Modal for History -->
<div x-show="showRatingModal" 
     x-cloak
     {{-- ## PERUBAHAN DI SINI: Mengubah 'fixed' menjadi 'absolute' ## --}}
     class="absolute inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
     x-data="{ 
        rating: 0,
        review: '',
        isLoading: false,
        async submitRating() {
            if (this.rating === 0) return;
            this.isLoading = true;
            try {
                const response = await fetch('{{ route('products.rate') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    },
                    body: JSON.stringify({
                        product_id: selectedProductId,
                        order_id: currentOrderId,
                        rating: this.rating,
                        review: this.review
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Refresh the page to show the new rating
                    window.location.reload();
                } else {
                    // Handle potential errors from the server, e.g., already rated
                    alert(data.message || 'Gagal mengirim ulasan.');
                }
            } catch (error) {
                console.error('Error submitting rating:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            } finally {
                this.isLoading = false;
                showRatingModal = false;
            }
        }
     }">
    <div class="bg-white rounded-lg max-w-md w-full p-6 m-4 shadow-xl" @click.away="showRatingModal = false">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-star text-pink-500 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-1">Bagaimana dengan produk ini?</h3>
            <p class="text-sm text-gray-600">Beri rating untuk produk yang Anda beli</p>
        </div>

        <form @submit.prevent="submitRating">
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

            <!-- Submit Buttons -->
            <div class="flex justify-between">
                <button type="button"
                    @click="showRatingModal = false"
                    class="px-4 py-2 text-gray-600 hover:text-gray-700">
                    Batal
                </button>
                <button type="submit"
                    :disabled="rating === 0 || isLoading"
                    class="bg-pink-600 text-white px-6 py-2 rounded-lg hover:bg-pink-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center">
                    <span x-show="!isLoading">Kirim Rating</span>
                    <span x-show="isLoading">
                        <i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
