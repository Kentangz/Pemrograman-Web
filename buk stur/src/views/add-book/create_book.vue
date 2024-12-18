<template>
  <div class="container mt-5">
    <div class="text-center mb-4">
      <h2 class="display-4 font-weight-bold text-primary">Add New Book</h2>
    </div>

    <div class="card shadow-lg rounded">
      <div class="card-body p-5">
        <form @submit.prevent="createBook">
          <!-- Book Name -->
          <div class="mb-4">
            <label for="bookName" class="form-label font-weight-bold large-label">Book Name</label>
            <input type="text" class="form-control form-control-lg" id="bookName" v-model="bookName" required />
          </div>

          <!-- Creator -->
          <div class="mb-4">
            <label for="creator" class="form-label font-weight-bold large-label">Creator</label>
            <input type="text" class="form-control form-control-lg" id="creator" v-model="creator" required />
          </div>

          <!-- Price -->
          <div class="mb-4">
            <label for="price" class="form-label font-weight-bold large-label">Price</label>
            <input type="number" class="form-control form-control-lg" id="price" v-model="price" min="0" step="0.01" required />
          </div>

          <!-- Description -->
          <div class="mb-4">
            <label for="description" class="form-label font-weight-bold large-label">Description</label>
            <textarea class="form-control form-control-lg" id="description" v-model="description" rows="5" required></textarea>
          </div>

          <!-- Category -->
          <div class="mb-4">
            <label for="category" class="form-label font-weight-bold large-label">Category</label>
            <select id="category" v-model="selectedCategory" class="form-select form-select-lg" required>
              <option value="" disabled>Select a category</option>
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.category_name }}
              </option>
            </select>
          </div>

          <!-- Image Upload -->
          <div class="mb-4">
            <label for="image" class="form-label font-weight-bold large-label">Book Image</label>
            <input type="file" id="image" @change="handleImageUpload" class="form-control form-control-lg" accept="image/*" required />
          </div>

          <!-- Submit Button -->
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success btn-lg shadow-sm">Add Book</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../../api'; // Import API service

export default {
  name: 'CreateBook',
  data() {
    return {
      bookName: '',
      creator: '',
      price: 0,
      description: '',
      selectedCategory: '',
      image: null,
      categories: [] // Array to store category options
    };
  },
  methods: {
    fetchCategories() {
      // Fetch available categories from the API
      api.get('/categories')
        .then(response => {
          this.categories = response.data.data;
        })
        .catch(error => {
          console.error('Error fetching categories:', error);
        });
    },
    handleImageUpload(event) {
      this.image = event.target.files[0];
    },
    createBook() {
      if (!this.image) {
        alert('Please upload an image.');
        return;
      }

      // Prepare form data for API request
      const formData = new FormData();
      formData.append('book_name', this.bookName);
      formData.append('creator', this.creator);
      formData.append('price', this.price);
      formData.append('description', this.description);
      formData.append('category_id', this.selectedCategory);
      formData.append('image', this.image);

      api.post('/books', formData)
        .then(() => {
          this.$router.push('/add-book'); // Redirect to book list after successful creation
        })
        .catch(error => {
          console.error('Error creating book:', error);
        });
    }
  },
  mounted() {
    this.fetchCategories(); // Fetch categories on component mount
  }
};
</script>

<style scoped>
.text-primary {
  font-size: 2.8rem;
}

.card {
  border-radius: 15px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.card-body {
  padding: 2.5rem;
}

.form-control-lg {
  padding: 1.2rem;
  font-size: 1.1rem;
  border-radius: 10px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.mb-4 {
  margin-bottom: 2rem;
}

.btn-lg {
  padding: 0.75rem 1.5rem;
  font-size: 1.2rem;
  border-radius: 30px;
  transition: background-color 0.3s ease, transform 0.2s ease-in-out;
}

.btn-success {
  background-color: #28a745;
  border-color: #28a745;
}

.btn-success:hover {
  background-color: #218838;
  border-color: #1e7e34;
  transform: scale(1.05);
}

.btn-success:focus {
  outline: none;
  box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

.text-center {
  text-align: center;
}

.font-weight-bold {
  font-weight: 600;
}

/* Increased size for form labels */
.large-label {
  font-size: 1.2rem;
}

@media (max-width: 768px) {
  .container {
    padding: 1.5rem;
  }

  .card-body {
    padding: 1.5rem;
  }

  .btn-lg {
    width: 100%;
  }
}
</style>
