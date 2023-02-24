<!DOCTYPE html>
<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="landing page for honours project artifact">
    <meta name="author" content="Charlie Mulholland | 1900313">
    <title>De-DeBugger</title>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js.map"></script>
    <script type="text/javascript" src="js/search.js"></script>
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <link href="css/headers.css" rel="stylesheet">
    <link href="css/carousel.css" rel="stylesheet">
    <link href="css/other.css" rel="stylesheet">


    </head>
    <body id="search">
      <header>
        <div class="px-3 py-2 text-bg-dark">
          <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
              <a href = "index.html" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                <img class="bi me-2" width="50%" height="50%" src="img/Logo.png" ></img>
              </a>
    
              <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                <li>
                  <a href="index.html" class="nav-link text-white">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"/></svg>
                    Home
                  </a>
                </li>
                <li>
                  <a href="search.php" class="nav-link text-secondary">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#speedometer2"/></svg>
                    Search
                  </a>
                </li>
                <li>
                  <a href="tutorial.html" class="nav-link text-white">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#table"/></svg>
                    Tutorials
                  </a>
                </li>
                <li>
                  <a href="help.html" class="nav-link text-white">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#grid"/></svg>
                    Help
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        </header>

        <main>

            <div class="p-5 mb-4 rounded-3">
                <div class="container-fluid py-5">
                <img class="bd-placeholder-img-lg" height="100%" width="100%" src="img/SearchLong.png"></img>
                  <h1 class="display-5 fw-light text-light">Error Troubleshooting.</h1>
                  <p class="col-md-8 fs-4 text-light">Submit an error code or description and our advanced algorithm will promptly search and provide you with the most suitable and informative tutorial to assist you in fixing the issue.</p>
                  
                </div>
            </div>

            <div class="container">
              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <h2 class="fw-normal text-light">Enter your error code or phrase here!</h2>
                  <br>
                  <form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" id="searchTerm" type="text" placeholder="Search" aria-label="Search" name="term">
                  <button class="btn btn-success my-2 my-sm-0" type="submit" onclick="searchData()">Search</button>
                </form></div>
                <div class="col-lg-2"></div>
              </div>

              <hr>
              <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6"><h2 class="fw-normal text-light">Search Results</h2></div>
                <div class="col-lg-3"></div>
              </div>

              <?php

                // Check if the search term is defined
                if(isset($_GET['term'])) {
                  $searchTerm = $_GET['term'];
                
                  // Connect to the database
                  $conn = mysqli_connect('localhost', 'dedezvrg_admin', '7Nwiq?;xZ=JJ', 'dedezvrg_dedeBugger');
                
                  // Execute the SQL query
                  $result = mysqli_query($conn, "SELECT * FROM Search WHERE Title LIKE '%$searchTerm%' OR Description LIKE '%$searchTerm%'");
                
                  // Check if the query was successful
                  if($result !== false) {
                    // Fetch the result as an associative array
                    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                  
                    // Close the database connection
                    mysqli_close($conn);
                  
                    // Set the content type header
                    header('Content-Type: application/json');
                  
                    // Output the result as JSON
                    echo '<div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6" id="results"><p id="results">'; echo json_encode($data);
                    echo '</p></div>
                    <div class="col-lg-3"></div>
                    </div>';
                  }
                  else {
                    // Close the database connection
                    mysqli_close($conn);
                  
                    // Output an error message
                    echo "Error executing SQL query.";
                    echo '<div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6" id="results"><p id="results">Error executing SQL query.</p>';
                    echo '</div>
                    <div class="col-lg-3"></div>
                    </div>';
                  }
                }
                else {
                  // Output an error message
                  
                  echo "Error executing SQL query.";
                    echo '<div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6" id="results"><p id="results">Search term not defined.</p>';
                    echo '</div>
                    <div class="col-lg-3"></div>
                    </div>';
                }
              
              ?>


              
              <hr>
              <div class="row">
                  <div class="col-lg-3"></div>
                  <div class="col-lg-6"><h2 class="fw-normal text-light">Last Search</h2></div>
                  <div class="col-lg-3"></div>
              </div>
              <div class="row">
                  <div class="col-lg-3"></div>
                  <div class="col-lg-6">
                    <p id="previous-search"></p>
                  </div>
                  <div class="col-lg-3"></div>
              </div>
            </div>
            <hr>
            

            
            

            
          
          
            <script src="js/bootstrap.bundle.min.js"></script>
        </main>

        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-0 border-top text-bg-dark">
          <div class="col mb-3">
            <a href = "index.html" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
              <img class="bi me-2" width="100%" height="100%" role="img" aria-label="Logo" src="img/Logo.png"></img>
            </a>
            <p class="text-muted">&copy; 2022</p>
          </div>
      
          <div class="col mb-3">
      
          </div>
      
          <div class="col mb-3">
            <h5>Navigate</h5>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="tutorial.html" class="nav-link p-0 text-muted">Tutorials</a></li>
              <li class="nav-item mb-2"><a href="search.php" class="nav-link p-0 text-muted">Search</a></li>
              <li class="nav-item mb-2"><a href="help.html" class="nav-link p-0 text-muted">Help</a></li>
              
              
            </ul>
          </div>
      
          <div class="col mb-3">
            <h5>Policy</h5>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Legal</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Privacy</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Cookies</a></li>
              
              
            </ul>
          </div>
      
          <div class="col mb-3 ">
            <h5>Socials</h5>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Twitter</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Instagram</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Reddit</a></li>
              
              
            </ul>
          </div>
    </footer>
        <script>
            const form = document.querySelector('form');
            const input = document.querySelector('input[type="text"]');
            const previousSearchDiv = document.getElementById('previous-search');
            const previousSearchTerm = localStorage.getItem('previousSearch');

            if (previousSearchTerm) {
              previousSearchDiv.innerHTML = `${previousSearchTerm}`;
            }
          
            form.addEventListener('submit', (event) => {
              event.preventDefault();
              const searchTerm = input.value;
              localStorage.setItem('previousSearch', searchTerm);
              form.submit();
            });
          </script>
    </body>
</html>