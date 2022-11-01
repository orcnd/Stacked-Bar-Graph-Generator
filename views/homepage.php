<?php $this->view('header'); ?> 

<style>
@-webkit-keyframes tada {
  from {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }

  10%, 20% {
    -webkit-transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
    transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
  }

  30%, 50%, 70%, 90% {
    -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
    transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
  }

  40%, 60%, 80% {
    -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
    transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
  }

  to {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}

@keyframes tada {
  from {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }

  10%, 20% {
    -webkit-transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
    transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
  }

  30%, 50%, 70%, 90% {
    -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
    transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
  }

  40%, 60%, 80% {
    -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
    transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
  }

  to {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}

.tada {
  -webkit-animation-name: tada;
  animation-name: tada;
  
}

@-webkit-keyframes pulse {
  from {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }

  50% {
    -webkit-transform: scale3d(1.05, 1.05, 1.05);
    transform: scale3d(1.05, 1.05, 1.05);
  }

  to {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}

@keyframes pulse {
  from {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }

  50% {
    -webkit-transform: scale3d(1.05, 1.05, 1.05);
    transform: scale3d(1.05, 1.05, 1.05);
  }

  to {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}

.pulse {
  -webkit-animation-name: pulse;
  animation-name: pulse;
}

.animated {
  -webkit-animation-duration: 6s;
  animation-duration: 6s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  animation-iteration-count: infinite;
}
</style>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Stacked Bar Graph Generator</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#dataModal">Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#" data-bs-toggle="modal"  data-bs-target="#settingsModal">Settings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="sample.xlsx" download>Sample Data</a>
        </li>
        <li>
            <a  href="#" id="regenerateButton" class="btn btn-primary pulse animated">Generate</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>

<div id="canvasContainer">
    <canvas id="myChart" width="400" height="400"></canvas>
</div>

<div class="modal" id="dataModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <textarea class="form-control" id="csvData" rows="12"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="settingsModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Settings</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <ul class="list-group">
      <li class="list-group-item">
            <div class="input-group">       
                <div class="input-group-text">data min:</div>
                <input class="form-control form-control-sm" id="min" placeholder="min" type="number" value="0">
            </div>
        </li>
        <li class="list-group-item">
            <div class="input-group">       
                <div class="input-group-text">data max:</div>
                <input class="form-control form-control-sm" id="max" placeholder="max" type="number" value="100">
            </div>
        </li>
        <li class="list-group-item">
          <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="autoMinMax" checked>
              <label class="form-check-label" for="autoMinMax">
                Auto calculate min/max
              </label>
            </div>
        </li>
        <li class="list-group-item">
            <label>Bar Inside text color</label>    
                <input type="color" id="barInsideColor">
            </label>
        </li>

        <li class="list-group-item">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="barInsideAmount">
              <label class="form-check-label" for="barInsideAmount">
                Bar Inside amount
              </label>
            </div>
        </li>

        <li class="list-group-item">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="barInsidePercentage" checked>
              <label class="form-check-label" for="barInsidePercentage">
                Bar Inside percentage
              </label>
            </div>
        </li>

        <li class="list-group-item">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="responsiveSize">
              <label class="form-check-label" for="responsiveSize">
                Responsive Size
              </label>
            </div>
        </li>
        <li class="list-group-item">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="trendline" checked>
              <label class="form-check-label" for="trendline">
                Trendline
              </label>
            </div>
        </li>

        <li class="list-group-item">
            <div class="input-group">       
                <div class="input-group-text">width:</div>
                <input class="form-control form-control-sm" id="width" placeholder="width" type="number" value="1200">
            </div>
        </li>
        <li class="list-group-item">
            <div class="input-group">       
                <div class="input-group-text">height:</div>
                <input class="form-control form-control-sm" id="height" placeholder="height" type="number" value="500">
            </div>
        </li>
      </ul>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php $this->view('footer');
