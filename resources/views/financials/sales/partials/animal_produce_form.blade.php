<div id="animal-produce-fields" style="display: none;">
    <div class="mb-3">
      <label>Description</label>
      <textarea id="description-animal" name="Description" class="form-control" style="height: 200px;">{{ old('Description') }}</textarea>
      <input type="hidden" name="hiddenDescription" id="hiddenDescription-animal" value="{{ old('Description') }}" />
      @error('Description') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
      

      <div class="mb-3">
          <label>Packaging Option</label>
          <input type="text" id="packaging-option-animal" name="packaging_option" value="30 * 1 Tray" class="form-control" readonly />
          @error('packaging_option') <span class="text-danger">{{ $message }}</span> @enderror
      </div>

      <div class="mb-3">
        <label>No. of Trays</label>
        <input type="number" id="numTrays-animal" name="Quantity" class="form-control" value="{{ old('Quantity') }}" oninput="calculateTotalPriceAnimal()" />
        @error('Quantity') <span class="text-danger">{{ $message }}</span> @enderror
      </div>
    
      <div class="mb-3">
        <label>Unit Price</label>
        <input type="number" id="unitPrice-animal" name="Unit_Price" class="form-control" value="{{ old('Unit_Price') }}" oninput="calculateTotalPriceAnimal()" />
        @error('Unit_Price') <span class="text-danger">{{ $message }}</span> @enderror
      </div>
    
      <div class="mb-3">
        <label>Total Price</label>
        <input type="number" id="totalPrice-animal" name="Total_Price" class="form-control" value="{{ old('Total_Price') }}" readonly/>
        @error('Total_Price') <span class="text-danger">{{ $message }}</span> @enderror
      </div>

    <div class="mb-3">
      <label>Payment Status</label>
      <select id="Payment_Status-animal" name="Payment_Status" class="form-control" required>
          <option value="Paid" class="text-success">Paid</option>
          <option value="Un-Paid" class="text-danger" selected>Un-Paid</option>
          <option value="Pending" class="text-warning">Pending</option>
      </select>
      @error('Payment_Status ') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
      <label>Sale Date(mm/dd/yyyy)</label>
      <input type="date" id="saleDate-animal" name="Sale_Date" class="form-control" value="{{ old('Sale_Date') }}" />
      @error('Sale_Date') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Quill editor for Description
    var quillAnimal = new Quill('#description-animal', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': '1' }, { 'header': '2' }],
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image'],
                [{ 'align': [] }],
                ['clean']
            ]
        }
    });

    // Sync Quill editor content with hidden input
    const descriptionTextareaAnimal = document.getElementById('description-animal');
    const hiddenDescriptionInputAnimal = document.getElementById('hiddenDescription-animal');

    descriptionTextareaAnimal.addEventListener('input', function() {
        hiddenDescriptionInputAnimal.value = descriptionTextareaAnimal.value;
    });

    
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryId = {{ $categoryId }}; // Assuming $categoryId is passed from the backend

        if (categoryId === 3) {
            document.getElementById('animal-produce-fields').style.display = 'block';
        } else {
            document.getElementById('animal-produce-fields').style.display = 'none';
        }
    });
</script>
<script>
    // Calculate total price
    function calculateTotalPriceAnimal() {
        var numTrays = document.getElementById('numTrays-animal').value;
        var unitPrice = document.getElementById('unitPrice-animal').value;
        var totalPrice = numTrays * unitPrice;

        document.getElementById('totalPrice-animal').value = totalPrice || 0;
    }

    // Add event listener for total price calculation
    document.getElementById('numTrays-animal').addEventListener('input', calculateTotalPriceAnimal);
    document.getElementById('unitPrice-animal').addEventListener('input', calculateTotalPriceAnimal);
</script>