<template>
  <div class="container mt-5">
    <div class="text-center mb-4">
      <h2 class="display-4 font-weight-bold text-primary">Edit Category</h2>
    </div>

    <div class="mb-4">
      <h5 class="font-weight-bold text-muted">Category ID: <strong>{{ categoryId }}</strong></h5>
    </div>

    <div class="card shadow-lg rounded">
      <div class="card-body p-5">
        <form @submit.prevent="updateCategory">
          <div class="mb-4">
            <label for="category_name" class="form-label font-weight-bold">Category Name</label>
            <input
              type="text"
              class="form-control form-control-lg"
              id="category_name"
              v-model="categoryName"
              required
            />
          </div>

          <div class="mb-4">
            <label for="description" class="form-label font-weight-bold">Description</label>
            <textarea
              class="form-control form-control-lg"
              id="description"
              v-model="description"
              rows="5"
              required
            ></textarea>
          </div>

          <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success btn-lg shadow-sm">Update Category</button>
            <button type="button" class="btn btn-secondary btn-lg shadow-sm" @click="cancelEdit">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../../../api';

export default {
  name: 'EditCategory',
  data() {
    return {
      categoryId: '',
      categoryName: '',
      description: '',
    };
  },
  methods: {
    fetchCategory() {
      const id = this.$route.params.id;
      this.categoryId = id; // Set category ID when fetched
      api
        .get(`/categories/${id}`)
        .then((response) => {
          if (response && response.data && response.data.data) {
            this.categoryName = response.data.data.category_name;
            this.description = response.data.data.description;
          } else {
            console.error('Expected fields (category_name, description) are missing in the response data.');
          }
        })
        .catch((error) => {
          console.error('Error fetching category data:', error);
          alert('Failed to load category data.'); // Alert on error
        });
    },
    updateCategory() {
      const id = this.$route.params.id;
      api
        .put(`/categories/${id}`, {
          category_name: this.categoryName,
          description: this.description,
        })
        .then(() => {
          this.$router.push('/category-list'); // Redirect to category list after update
        })
        .catch((error) => {
          console.error('Error updating category:', error);
          alert('Failed to update category.'); // Alert on error
        });
    },
    cancelEdit() {
      this.$router.push('/category-list'); // Redirect to category list without saving
    },
  },
  mounted() {
    this.fetchCategory(); // Fetch the category data when component is mounted
  },
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

.btn-secondary {
  background-color: #6c757d;
  border-color: #6c757d;
}

.btn-secondary:hover {
  background-color: #5a6268;
  border-color: #545b62;
  transform: scale(1.05);
}

.text-center {
  text-align: center;
}

.font-weight-bold {
  font-weight: 600;
}

.text-muted {
  color: #6c757d;
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
