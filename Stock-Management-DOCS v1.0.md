#
# Stock Purchase and Management Workflow:
#### 1. Stock Purchase:

* A stock purchase is made (e.g., seeds, fertilizers, chemicals).
* Record the purchase details (e.g., item, quantity, total cost, supplier, purchase date) in the Stock Inventory.
* These purchases are not tied to any specific Cycle_Id initially but stored in a General Stock Pool.

#### 2. Stock Inventory Management:

* Each item in stock is stored with attributes like:
    * Quantity Purchased
    * Unit Cost
    * Remaining Quantity
    * Stock Location/Batch
    * Expiry Date (if applicable)
Stock quantities are tracked for the overall farm without cycle-specific information at this point.

#### 3. Stock Allocation to a Cycle:

* When a cycle (with a specific Cycle_Id) begins, you allocate the necessary stock for that cycle.
* The allocation process would deduct from the General Stock Pool and create a record in the Cycle Allocation Table:
    * Cycle_Id (linked to the cycle)
    * Stock Item (from the general stock pool)
    * Allocated Quantity
    * Allocation Date
    * Remaining Quantity (for that item within the cycle)
    * Cost per Unit (helps determine cost per cycle)
* This allocation is directly tied to the cycle, and the stock now appears in both the Cycle_Id's Record and the Stock Pool.

#### 4. Stock Depletion:

* As the stock is used within the cycle, quantities are depleted in the Cycle Allocation Table. This table is always updated with the actual quantity used vs. allocated.
* If the entire allocation is not depleted by the end of the cycle, the remaining portion still appears in the cycle’s records as unused stock.


## Handling Remaining Stock and Stock Views:

##### Overall Stock View:

* The General Stock Pool reflects the total quantity of each stock item on the farm.
* After allocations to various cycles, this pool shows the remaining quantity in general farm storage, unaffected by the allocations unless fully used.

##### Cycle-Specific Stock View:

* Each Cycle_Id can have a breakdown of the stock that has been allocated to it:
    * Total Allocated
    * Total Used
    * Remaining Allocation

* This allows you to see not only the stock allocated but also how much is left after usage within a specific cycle.

## Dealing with Allocations Not Depleted:
* If a cycle finishes and the allocated stock is not fully depleted, you can:
    * Leave the unused stock allocated to that cycle (e.g., mark it as unused stock in that cycle).
    * Optionally, return the remaining stock to the general stock pool (if reusable).

<br/>

##
# Migrations & Table Structures
* To implement the outlined stock management workflow in Laravel, we need to create several tables through migrations that can handle the various parts of the system, such as purchasing, allocating, and tracking stock. Based on the workflow, I’ll break it down into the required tables and their structure.

### 1. <u>Stock Table (General Stock Pool)</u>
* This table will store information about all purchased stock that is not yet allocated to any specific cycle. 
* Each stock purchase is recorded here, with relevant details such as quantity, unit cost, and remaining stock.

##### Table Design:
```php
Schema::create('stocks', function (Blueprint $table) {
    $table->id();
    $table->string('item_name');
    $table->integer('total_quantity'); // Total purchased quantity
    $table->integer('remaining_quantity'); // Remaining quantity
    $table->decimal('unit_cost', 10, 2); // Cost per unit
    $table->decimal('total_cost', 10, 2); // Total purchase cost
    $table->timestamps(); // Created_at, Updated_at
});
```

### 2. Cycle Allocation Table
* This table will keep track of the stock allocated to specific cycles. It is linked to the stock pool table and the crop/herb cycles.

##### Table Design:
```php
Schema::create('cycle_allocations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('cycle_id')->constrained(); // Link to a cycle (foreign key)
    $table->foreignId('stock_id')->constrained(); // Link to the stock pool (foreign key)
    $table->integer('allocated_quantity'); // Quantity allocated to the cycle
    $table->date('allocation_date'); // Date of allocation
    $table->integer('remaining_quantity')->default(0); // Remaining quantity in this allocation (if partially used)
    $table->timestamps();
});
```

### 3. Cycle Table (If not already present)
* This is the table representing different cycles of crops/herbs. If you already have this, no need to create a new one. However, if not, this is what the table structure would look like:

##### Table Design:
```php
Schema::create('cycles', function (Blueprint $table) {
    $table->id();
    $table->string('cycle_name'); // Name of the cycle (e.g., "Tomato Planting Cycle")
    $table->date('start_date'); // Start date of the cycle
    $table->date('end_date')->nullable(); // End date (nullable if ongoing)
    $table->timestamps();
});
```
### 4. Stock Usage Table (Depletion of Stock)
* This table will track when stock is actually used during a cycle. It will link back to the cycle and allocation tables to keep track of how much stock has been used from the allocation.

##### Table Design:
```php
Schema::create('stock_usages', function (Blueprint $table) {
    $table->id();
    $table->foreignId('cycle_id')->constrained(); // Link to the cycle (foreign key)
    $table->foreignId('allocation_id')->constrained('cycle_allocations'); // Link to cycle allocation (foreign key)
    $table->integer('quantity_used'); // Quantity used from this allocation
    $table->date('usage_date'); // Date when the stock was used
    $table->timestamps();
});
```
### 5. Purchase Table (Optional - If you want to track individual stock purchases separately)
* This table would keep track of each individual stock purchase, which can be useful for auditing and historical records. If this is not required, you can merge this functionality with the stock table.

Table Design:
```php
Schema::create('purchases', function (Blueprint $table) {
    $table->id();
    $table->string('item_name');
    $table->integer('quantity'); // Quantity of the purchased item
    $table->decimal('unit_cost', 10, 2); // Cost per unit
    $table->decimal('total_cost', 10, 2); // Total cost of purchase
    $table->timestamps();
});
```
### 6. Reports (Not a Table, but Query-Based)
* The final report views for "Overall Stock Pool" and "Cycle-Specific Stock Allocation" can be generated using Laravel queries, rather than requiring new tables.
* The stocks, cycle_allocations, and stock_usages tables will give you all the data needed for these reports.

##