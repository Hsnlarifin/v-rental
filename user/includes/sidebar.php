<div class="sidenav">
  <a class="dropdown-btn" href="dashboard.php">Dashboard</a>

  <button class="dropdown-btn">Users
    <i class="fa fa-caret-right"></i>
  </button>
      <div class="dropdown-container">
        <a href="index_cust.php">Customer</a>
        <a href="index_staff.php">Staff</a>
      </div>

  <button class="dropdown-btn">Branch
    <i class="fa fa-caret-right"></i>
  </button>
        <div class="dropdown-container">
            <a href="index_branch.php">Location</a>
        </div>
    <a class="dropdown-btn" href="#">Change Password</a>
    <a class="dropdown-btn" href="logout.php">Log Out</a>
</div>


<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>