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
    <div class="grid grid-cols-1 gap-9 sm:grid-cols-2">
      <div class="flex flex-col gap-9">
        <!-- add user Form -->
        <div
          class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
          <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
            <h3 class="font-semibold text-black dark:text-white">
              Add user
            </h3>
          </div>
          <form wire:submit.prevent="addMember">
            <div class="p-6.5">
              <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                  <label class="mb-2.5 block text-black dark:text-white">
                    Full Name
                  </label>
                  <input wire:model="name" type="text" 
                    class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('name')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror 
                </div>

                <div class="w-full xl:w-1/2">
                  <label class="mb-2.5 block text-black dark:text-white">
                    Email
                  </label>
                  <input wire:model="email" type="email" 
                    class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    @error('email')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>
              </div>

              <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">
                  Password
                </label>
                <input wire:model="password" type="password" 
                  class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                  @error('password')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                  @enderror
                </div>

              <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray" type="submit">
                Add user
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
    <!-- ====== Form Layout Section End -->
  </div>