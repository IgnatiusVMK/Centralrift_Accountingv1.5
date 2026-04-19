
#
# Workflow Outline for Stock Management:
[x] ***1. <u>Start with Stock Purchase:***</u>

* Create a box labeled "Purchase Stock".
* Add details like:
    * Item
    * Quantity
    * Total Cost

[x] ***2. <u>General Stock Pool:***</u>

* Create a box labeled "Stock Pool (Not tied to Cycle_Id)".
* This is where all purchased items are stored.
* Add attributes like:
    * Total Quantity
    * Remaining Quantity
    * Unit Cost
    * Connect an arrow from "Purchase Stock" to "Stock Pool".

[x] ***3. <u>Allocate Stock to Cycle:***</u>

* Create a decision box labeled "Allocate Stock to Cycle".
* Note: "Deduct from Stock Pool, record in Cycle Allocation Table".
* Connect an arrow from "Stock Pool" to this box.

[x] ***4. <u>Cycle Allocation Table:***</u>

* Create a box labeled "Cycle Allocation Table".
* Add attributes:
    * Cycle_Id
    * Stock Item
    * Allocated Quantity
    * Allocation Date
    * Remaining Quantity
* Connect an arrow from "Allocate Stock to Cycle" to "Cycle Allocation Table".

[x] ***5. <u>Update Stock Pool:***</u>

* Create a feedback arrow from "Allocate Stock to Cycle" back to the "Stock Pool" box.
* Note: "Update remaining quantity after allocation".

[x] ***6. <u>Stock Depletion:***</u>

* Create a box labeled "Deplete Stock as Used".
* Connect arrows from both "Cycle Allocation Table" and "Stock Pool" to this box.
* Add a note: "Update quantities in both tables".

[x] ***7. <u>Final Reports:</u>***

* Create two boxes:
    * "View Overall Stock Pool": Showing remaining stock in the general pool.
    * "View Cycle-Specific Stock Allocation": Showing total allocated, used, and remaining stock per cycle.
* Connect arrows from the previous boxes to the final report boxes.

<br/>
