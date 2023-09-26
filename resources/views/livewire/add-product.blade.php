<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
    <!-- ====== Form Layout Section Start -->
    <!-- Alerts Item -->
    @if (session()->has('message'))
      <div class="grid grid-cols-2 gap-4 mb-4">
          <div class="col-span-1 flex border-l-6 border-[#34D399] bg-[#34D399] bg-opacity-[15%] dark:bg-[#1B1B24] px-7 py-3 shadow-md dark:bg-opacity-30">
              <div class="mr-5 flex h-9 w-full max-w-[36px] items-center justify-center rounded-lg bg-[#34D399]">
              <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                  d="M15.2984 0.826822L15.2868 0.811827L15.2741 0.797751C14.9173 0.401867 14.3238 0.400754 13.9657 0.794406L5.91888 9.45376L2.05667 5.2868C1.69856 4.89287 1.10487 4.89389 0.747996 5.28987C0.417335 5.65675 0.417335 6.22337 0.747996 6.59026L0.747959 6.59029L0.752701 6.59541L4.86742 11.0348C5.14445 11.3405 5.52858 11.5 5.89581 11.5C6.29242 11.5 6.65178 11.3355 6.92401 11.035L15.2162 2.11161C15.5833 1.74452 15.576 1.18615 15.2984 0.826822Z"
                  fill="white" stroke="white"></path>
              </svg>
              </div>
              <div class="w-full">
              <h5 class="mb-3 text-lg font-bold text-black dark:text-[#34D399]">
                  <p class="text-base leading-relaxed text-body">
                      {{ session('message') }}
                  </p>
              </h5>
              </div>
          </div>
      </div> 
    @endif
    <!-- Alerts Item -->
    <div class="row">
      <div class="flex flex-col gap-9">
        <!-- add user Form -->
        <div
          class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
          <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
            <h3 class="font-semibold text-black dark:text-white">
              Add product
            </h3>
          </div>
          {{-- barcodeScan --}}
          <div id="result"></div>      
          <form wire:submit.prevent="addProduct">
            <div class="row">
              <div class="p-6.5">
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                  <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                      Title
                    </label>
                    <input wire:model="title" type="text" 
                      class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      @error('title')
                          <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                      @enderror 
                  </div>

                  <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                      SKU 
                    </label>
                    <input wire:model="sku" type="text" 
                      class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      @error('sku')
                          <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                      @enderror
                  </div>

                  <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                      Price 
                    </label>
                    <input wire:model="price" type="text" 
                      class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      @error('price')
                          <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                      @enderror
                  </div>

                  <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                      Stock
                    </label>
                    <input wire:model="quantity" type="text" 
                      class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      @error('quantity')
                          <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                      @enderror 
                  </div>
                  
                </div>

                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                  
                  <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                      Category 
                    </label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                      <select wire:model="category_id"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                          <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                      </select>
                      @error('category_id')
                          <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                      @enderror 
                    </div>
                  </div>

                  <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                      Brand 
                    </label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                      <select wire:model="brand_id"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                        <option value="">Select brand</option>
                        @foreach($brands as $brand)
                          <option value="{{$brand->id}}">{{$brand->title}}</option>
                        @endforeach
                      </select>
                      @error('brand_id')
                          <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                      @enderror 
                    </div>
                  </div>

                  <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                      Warehouse 
                    </label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                      <select wire:model="warehouse_id"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                        <option value="">Select warehouse</option>
                        @foreach($warehouses as $warehouse)
                          <option value="{{$warehouse->id}}">{{$warehouse->title}}</option>
                        @endforeach
                      </select>
                      @error('warehouse_id')
                          <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                      @enderror 
                    </div>
                  </div>

                  <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                      Status 
                    </label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                      <select wire:model="status"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                        <option value="">Select status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                      @error('status')
                          <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                      @enderror 
                    </div>
                  </div>
                </div>
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                  <div class="w-full xl:w-1/2">
                    <label class="mb-2.5 block text-black dark:text-white">
                      Product Image 
                    </label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                      <input id="image" wire:change="$emit('fileChoosen')" type="file" 
                      class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                      @error('product_image')
                          <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                      @enderror 
                    </div>
                    <label class="mb-2.5 block text-black dark:text-white">
                      Description
                    </label>
                    <textarea wire:model="description" rows="6"
                      class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"></textarea>
                  
                    <div x-data="{ scannedJson: null}">
                      <div class="flex space-x-4">
                          <a href="#" id="startCamera" class=" text-center flex-1 rounded bg-primary p-3 font-medium text-gray mt-5">Scan Barcode </a>
                          <a href="#" id="stopCamera" class=" text-center flex-1 rounded bg-primary p-3 font-medium text-gray mt-5">Stop Camera </a>
                          <a href="#" x-on:click="initializeScanner()" class=" text-center flex-1 rounded bg-primary p-3 font-medium text-gray mt-5">Scan QR</a>
                          <button class=" text-center flex-1 rounded bg-primary p-3 font-medium text-gray mt-5" type="submit">Submit</button>
                      </div>
                    </div>  
                  </div>
                  <div class="w-full xl:w-1/2">
                    <video id="camera" playsinline></video>
                    <video id="preview" style="width: 100%;"></video>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
    <!-- ====== Form Layout Section End -->
  </div>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quagga@0.12.1/dist/quagga.min.js"></script>

<script>
  function initializeScanner() {
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function(content) {
        console.log('content',content);
        window.Livewire.emit('scanQRCode', content);
        //document.querySelector('[x-data]').__x.$data.scannedJson = JSON.parse(content);
      });

      Instascan.Camera.getCameras().then(function(cameras) {
          if (cameras.length > 0) {
            console.log('cameras[0]',cameras[0]);
              scanner.start(cameras[0]);
          } else {
              console.error('No cameras found.');
          }
      }).catch(function(error) {
          console.error(error);
      });
  }
  
</script>

{{-- barcode reader --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
  const videoElement = document.getElementById('camera');
  const startCameraButton = document.getElementById('startCamera');
  const stopCameraButton = document.getElementById('stopCamera');
  const resultElement = document.getElementById('result');
  let stream = null; // To keep track of the camera stream

  // Function to start the camera
  function startCamera() {
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
      navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (mediaStream) {
          stream = mediaStream; // Store the stream
          videoElement.srcObject = stream;
          videoElement.play();
        })
        .catch(function (error) {
          console.error('Camera access error:', error);
        });
    }

    Quagga.init({
      inputStream: {
        name: "Live",
        type: "LiveStream",
        target: videoElement,
      },
      decoder: {
        readers: ["ean_reader", "code_128_reader"],
      },
    }, function (err) {
      if (err) {
        console.error('Quagga initialization failed:', err);
        return;
      }
      Quagga.start();
    });

    Quagga.onDetected(function (result) {
      const code = result.codeResult.code;
      window.livewire.emit('scanQRCode', code,'barcode');
      //resultElement.innerHTML = `Scanned barcode: ${code}`;
      // You can do something with the scanned barcode, e.g., send it to the server.
    });
  }

  // Function to stop the camera
  function stopCamera() {
    if (stream) {
      const tracks = stream.getTracks();
      tracks.forEach(track => track.stop()); // Stop all tracks in the stream
      videoElement.srcObject = null; // Clear the video element
    }
  }

  // Add an event listener to start the camera when the "Start Camera" button is clicked
  startCameraButton.addEventListener('click', startCamera);

  // Add an event listener to stop the camera when the "Stop Camera" button is clicked
  stopCameraButton.addEventListener('click', stopCamera);
});

// function barcodeScan(){  
//     window.livewire.on('fileChoosen', () => {
//         let inputField = document.getElementById('image')
//         let file = inputField.files[0]
//         let reader = new FileReader();
//         reader.onloadend = () => {
//           window.livewire.emit('fileUpload', reader.result)
//         }
//         reader.readAsDataURL(file);
//     })

//     document.addEventListener("DOMContentLoaded", function () {
//       const videoElement = document.getElementById('camera');
//       const resultElement = document.getElementById('result');

//       if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
//           navigator.mediaDevices.getUserMedia({ video: true })
//               .then(function (stream) {
//                   videoElement.srcObject = stream;
//                   videoElement.play();
//               })
//               .catch(function (error) {
//                   console.error('Camera access error:', error);
//               });
//       }

//       Quagga.init({
//           inputStream: {
//               name: "Live",
//               type: "LiveStream",
//               target: videoElement,
//           },
//           decoder: {
//               readers: ["ean_reader", "code_128_reader"],
//           },
//       }, function (err) {
//           if (err) {
//               console.error('Quagga initialization failed:', err);
//               return;
//           }
//           Quagga.start();
//       });

//       Quagga.onDetected(function (result) {
//           const code = result.codeResult.code;
//           window.livewire.emit('scanQRCode','1430')
//           //resultElement.innerHTML = `Scanned barcode: ${code}`;
//           // You can do something with the scanned barcode, e.g., send it to the server.
//       });
//   });
// }
</script>

