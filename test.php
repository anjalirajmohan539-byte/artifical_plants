<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="add_product.css">
</head>
<style>
    body {
  background-color: #f5f7fb;
}

.card {
  border-radius: 12px;
}

.image-preview {
  width: 100%;
  height: 160px;
  border: 1px dashed #ccc;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #999;
  font-size: 14px;
  overflow: hidden;
}

.image-preview img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

</style>
<body>

<div class="container-fluid py-4">
  <div class="row">

    <!-- ADD PRODUCT FORM -->
    <div class="col-lg-4 mb-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="mb-3">Add Product</h5>

          <form id="productForm" novalidate>

            <!-- Image -->
            <label class="form-label">Product Image <span class="text-danger">*</span></label>
            <div class="image-preview mb-2" id="previewBox">No image</div>
            <input type="file" class="form-control" id="image"
                   accept="image/*" required>

            <!-- Name -->
            <label class="form-label mt-3">Product Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" required>

            <!-- Type -->
            <label class="form-label mt-3">Product Type <span class="text-danger">*</span></label>
            <select class="form-select" id="type" required>
              <option value="">Choose type</option>
              <option>Artificial Plants</option>
              <option>Vases</option>
              <option>Decor</option>
              <option>Other</option>
            </select>

            <!-- Color -->
            <div class="row mt-3">
              <div class="col">
                <label class="form-label">Color Name</label>
                <input type="text" class="form-control">
              </div>
              <div class="col">
                <label class="form-label">Color Code</label>
                <input type="text" class="form-control" placeholder="#fff">
              </div>
            </div>

            <!-- Price & Count -->
            <div class="row mt-3">
              <div class="col">
                <label class="form-label">Price (₹) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="price" required>
              </div>
              <div class="col">
                <label class="form-label">Count <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="count" required>
              </div>
            </div>

            <!-- Material -->
            <label class="form-label mt-3">Product Material <span class="text-danger">*</span></label>
            <select class="form-select" required>
              <option value="">Choose material</option>
              <option>Plastic</option>
              <option>Fiber</option>
              <option>Metal</option>
            </select>

            <!-- Description -->
            <label class="form-label mt-3">Description</label>
            <textarea class="form-control" rows="3"></textarea>

            <!-- Buttons -->
            <div class="d-flex gap-2 mt-4">
              <button type="submit" class="btn btn-primary w-100">Save</button>
              <button type="reset" class="btn btn-outline-secondary w-100">Reset</button>
            </div>

          </form>
        </div>
      </div>
    </div>

    <!-- PRODUCT LIST -->
    <div class="col-lg-8">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="mb-3">Products List</h5>

          <div class="table-responsive">
            <table class="table align-middle">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Price</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Decor</td>
                  <td>Other</td>
                  <td>₹230</td>
                  <td>
                    <button class="btn btn-sm btn-outline-primary">Edit</button>
                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<script src="add_product.js"></script>
</body>

<script>
    const form = document.getElementById('productForm');
const imageInput = document.getElementById('image');
const previewBox = document.getElementById('previewBox');

imageInput.addEventListener('change', () => {
  const file = imageInput.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = () => {
    previewBox.innerHTML = `<img src="${reader.result}">`;
  };
  reader.readAsDataURL(file);
});

form.addEventListener('submit', function (e) {
  if (!form.checkValidity()) {
    e.preventDefault();
    e.stopPropagation();
    alert("Please fill all required fields correctly.");
  }
});

</script>
</html>













