<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
     <!-- resources/views/livewire/file-upload.blade.php -->

     <div class="modal-body" x-data="{ file: '', showMessage: false }">
        <div class="p-6.5">
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/1">
                    <input id="file" x-ref="fileInput" x-model="file" type="file" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('file')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <p x-show="showMessage">The input is not empty:</p>

            <a href="javascript:void(0)" @click="showMessage = file.trim() !== ''" wire:click="importProduct()" class="inline-flex items-center justify-center rounded-md border border-primary py-4 px-10 text-center font-medium text-primary hover:bg-opacity-90 lg:px-8 xl:px-10">
                Upload
            </a>

            <a href="javascript:void(0)" @click="isOpen = false" x-ref="modalCloseButton" class="inline-flex items-center justify-center rounded-md border border-primary py-4 px-10 text-center font-medium text-primary hover:bg-opacity-90 lg:px-8 xl:px-10">
                Close
            </a>
        </div>
    </div>

    
     <div x-data="{ inputValue: '', showMessage: false }">
        <input type="text" x-model="inputValue" placeholder="Type something...">
        <button @click="showMessage = inputValue.trim() !== ''">Check Input</button>
        <p x-show="showMessage">The input is not empty: <span x-text="inputValue"></span></p>
    </div>


     <div x-data="{ showMessage: false, showMessageFunction: function() { this.showMessage = true; } }">
        <button @click="showMessageFunction()">Show Message</button>
        <p x-show="showMessage">This is the displayed message.</p>
    </div>


     <div x-data="{ showMessage: false }">
        <button @click="showMessage = !showMessage">Toggle Message</button>
        <p x-show="showMessage">This is the hidden message.</p>
    </div>


     <div class="modal-body" x-data="{ errorMessage: '', fileInput: null }">
        <div class="p-6.5">
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/1">
                    <input id="file" type="file" x-model="fileInput"
                           class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"/>
                    <span x-text="errorMessage" style="font-size: 11.5px; color: red;"></span>
                </div>
            </div>
            <a href="javascript:void(0)" x-on:click="uploadFile" class="inline-flex items-center justify-center rounded-md border border-primary py-4 px-10 text-center font-medium text-primary hover:bg-opacity-90 lg:px-8 xl:px-10">
                Upload
            </a>
            <a href="javascript:void(0)" @click="isOpen = false" x-ref="modalCloseButton" class="inline-flex items-center justify-center rounded-md border border-primary py-4 px-10 text-center font-medium text-primary hover:bg-opacity-90 lg:px-8 xl:px-10">
                Close
            </a>
        </div>
    
        <script>
            function uploadFile() {
                const fileInput = document.querySelector('#file');
                if (!fileInput.files.length) {
                    errorMessage = 'Please select a file.';
                    return;
                }
    
                // Proceed with your file upload logic here.
    
                // Clear the error message if successful.
                errorMessage = '';
            }
        </script>
    </div>
    
 </div>
 
      </div>
  </div>    