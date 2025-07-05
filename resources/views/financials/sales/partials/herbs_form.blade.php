<div id="herbs-fields" style="display: none;">
    <div class="mb-3">
        <label>Description</label>
        <textarea id="description-herbs" name="Description" class="form-control" style="height: 200px;">{{ old('Description') }}</textarea>
        <input type="hidden" name="hiddenDescription" id="hiddenDescription-herbs" value="{{ old('Description') }}" />
        @error('Description') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label>Packaging Options</label>
        <div class="form-check" style="padding-left: 50px">
            <input type="radio" id="option1-herbs" name="packaging_option" value="3Kg (30gms x 100)" class="form-check-input" onclick="calculateCartonsHerbs()" />
            <label for="option1-herbs" class="form-check-label">3Kg (30gms x 100)</label>
        </div>
        <div class="form-check" style="padding-left: 50px">
            <input type="radio" id="option2-herbs" name="packaging_option" value="1Kg (100gms x 10)" class="form-check-input" onclick="calculateCartonsHerbs()" />
            <label for="option2-herbs" class="form-check-label">1Kg (100gms x 10)</label>
        </div>
        <div class="form-check" style="padding-left: 50px">
            <input type="radio" id="option3-herbs" name="packaging_option" value="1.5Kg (150gms x 10)" class="form-check-input" onclick="calculateCartonsHerbs()" />
            <label for="option3-herbs" class="form-check-label">1.5Kg (150gms x 10)</label>
        </div>
        @error('packaging_option') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label>Net Weight (Kg)</label>
        <input type="number" id="netWeight-herbs" name="Net_Weight" class="form-control"
            value="{{ old('Net_Weight') }}"
            oninput="calculateCartonsHerbs(); calculateTotalPrice();" 
            onwheel="this.blur()"/>
        @error('Net_Weight') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label>No. of Cartons</label>
        <input type="number" id="numCartons-herbs" name="Quantity_of_packages" class="form-control" value="{{ old('Quantity_of_packages') }}" readonly />
        @error('Quantity_of_packages') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label>Payment Status</label>
        <select id="Payment_Status-herbs" name="Payment_Status" class="form-control" required>
            <option value="Paid" class="text-success">Paid</option>
            <option value="Un-Paid" class="text-danger" selected>Un-Paid</option>
            <option value="Pending" class="text-warning">Pending</option>
        </select>
        @error('Payment_Status') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label>Currency</label>
        <div class="form-check" style="padding-left: 50px">
            <input type="radio" id="option1-Currency" name="Currency" value="KES" class="form-check-input" />
            <label for="option1-Currency" class="form-check-label">KES</label>
        </div>
        <div class="form-check" style="padding-left: 50px">
            <input type="radio" id="option2-Currency" name="Currency" value="EUR" class="form-check-input"/>
            <label for="option2-Currency" class="form-check-label">EUR</label>
        </div>
        <div class="form-check" style="padding-left: 50px">
            <input type="radio" id="option3-Currency" name="Currency" value="USD" class="form-check-input"/>
            <label for="option3-Currency" class="form-check-label">USD</label>
        </div>
        <div class="form-check" style="padding-left: 50px">
            <input type="radio" id="option4-Currency" name="Currency" value="GBP" class="form-check-input"/>
            <label for="option4-Currency" class="form-check-label">GBP</label>
        </div>
        @error('Currency') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    
    <div class="mb-3">
        <label>Unit Price</label>
        <input type="number" id="unitPrice" name="Unit_Price" class="form-control" value="{{ old('Unit_Price') }}" oninput="calculateTotalPrice()" step="1" />
        @error('Unit_Price') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label>Amount</label>
        <input type="number" id="totalPrice" name="Total_Price" class="form-control" value="{{ old('Total_Price') }}" readonly />
        @error('Total_Price') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label>Delivery Date (mm/dd/yyyy)</label>
        <input type="date" name="Sale_Date" class="form-control" value="{{ old('Sale_Date') }}" />
        @error('Sale_Date') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Quill editor for Description
        var quillHerbs = new Quill('#description-herbs', {
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
        const descriptionTextareaHerbs = document.getElementById('description-herbs');
        const hiddenDescriptionInputHerbs = document.getElementById('hiddenDescription-herbs');
        descriptionTextareaHerbs.addEventListener('input', function() {
            hiddenDescriptionInputHerbs.value = descriptionTextareaHerbs.value;
        });

        

        
    });
</script>
<script>
    // Calculate the number of cartons based on the net weight and packaging option
    const netWeightInputHerbs = document.getElementById('netWeight-herbs');
        const numCartonsInputHerbs = document.getElementById('numCartons-herbs');
        const packagingOptionsHerbs = document.querySelectorAll('input[name="packaging_option"]');

        function calculateCartonsHerbs() {
            const netWeight = parseFloat(netWeightInputHerbs.value) || 0;
            const selectedOption = document.querySelector('input[name="packaging_option"]:checked');
            if (selectedOption) {
                const packagingSize = parseFloat(selectedOption.value);
                if (!isNaN(packagingSize) && packagingSize > 0) {
                    const numCartons = netWeight / packagingSize;
                    numCartonsInputHerbs.value = Math.ceil(numCartons);
                } else {
                    numCartonsInputHerbs.value = 0;
                }
            } else {
                numCartonsInputHerbs.value = 0;
            }
        }

        // Add event listeners for carton calculation
        netWeightInputHerbs.addEventListener('input', calculateCartonsHerbs);
        packagingOptionsHerbs.forEach(option => option.addEventListener('change', calculateCartonsHerbs));
</script>
<script>
    // Display form based on category
    const categoryId = {{ $categoryId ?? 'null' }}; // Ensure this value is passed from the backend
        if (categoryId === 1) {
            document.getElementById('herbs-fields').style.display = 'block';
        } else {
            document.getElementById('herbs-fields').style.display = 'none';
        }
</script>
<script>
    function calculateTotalPrice() {
        const netWeight = parseFloat(document.getElementById('netWeight-herbs').value) || 0;
        const unitPrice = parseFloat(document.getElementById('unitPrice').value) || 0;
        const total = netWeight * unitPrice;
        document.getElementById('totalPrice').value = total.toFixed(2);
    }
</script>

