<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
          Brand list
        </h2>

        <nav>
          <ol class="flex items-center gap-2">
            <li class="font-medium">
                <div class="">
                    <div x-data="{ isOpen: false }">
                        <button class="inline-flex items-center justify-center bg-primary py-4 px-10 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10" @click="isOpen = true 
                        $nextTick(() => $refs.modalCloseButton.focus())">
                            Add Brand
                        </button>
                        <div style="background-color: rgba(0, 0, 0, .5)" class="mx-auto absolute top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto" x-show="isOpen">
                            <div class="container mx-auto rounded p-4 mt-2 overflow-y-auto w-full xl:w-1/2">
                                <div class="bg-white rounded px-8 py-8">
                                    <!-- Alerts Item -->
                                    @if (session()->has('message'))
                                        <div class="grid grid-cols-1 gap-4 mb-4">
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
                                    <h1 class="font-bold text-2xl mb-3">Brand</h1>
                                    <div class="modal-body">
                                        <form wire:submit.prevent="add">
                                            <div class="p-6.5">
                                              <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                                                <div class="w-full xl:w-1/1">
                                                  <label class="mb-2.5 block text-black dark:text-white">
                                                    Title
                                                  </label>
                                                  <input wire:model="title" type="text" 
                                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                                    @error('title')
                                                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                                    @enderror 
                                                </div>
                                              </div>
                                                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                                                    <div class="w-full xl:w-1/1">
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
                                                <button type="submit" class="inline-flex items-center justify-center rounded-md border border-primary py-4 px-10 text-center font-medium text-primary hover:bg-opacity-90 lg:px-8 xl:px-10">
                                                    Add
                                                </button>
                                                <a href="javascript:void(0)" @click="isOpen = false" x-ref="modalCloseButton" class="inline-flex items-center justify-center rounded-md border border-primary py-4 px-10 text-center font-medium text-primary hover:bg-opacity-90 lg:px-8 xl:px-10">
                                                    Close
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
          </ol>
        </nav>
      </div>
      <!-- Breadcrumb End -->
    <div class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
        <div class="max-w-full overflow-x-auto">
          <table class="w-full table-auto">
            <thead>
              <tr class="bg-gray-2 text-left dark:bg-meta-4">
                <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                  ID
                </th>
                <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">
                  Title
                </th>
                <th class="min-w-[120px] py-4 px-4 font-medium text-black dark:text-white">
                  Status
                </th>
                <th class="py-4 px-4 font-medium text-black dark:text-white">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
                            <p class="text-sm">{{$brand->id}}</p>
                        </td>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{$brand->title}}</p>
                        </td>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                            <p class="text-black dark:text-white">@if($brand->status) Active @else Inactive @endif</p>
                        </td>
                        <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                        <div class="flex items-center space-x-3.5">
                            <button class="hover:text-primary" wire:click="editCategory({{ $brand->id }})">
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                    d="M8.99981 14.8219C3.43106 14.8219 0.674805 9.50624 0.562305 9.28124C0.47793 9.11249 0.47793 8.88749 0.562305 8.71874C0.674805 8.49374 3.43106 3.20624 8.99981 3.20624C14.5686 3.20624 17.3248 8.49374 17.4373 8.71874C17.5217 8.88749 17.5217 9.11249 17.4373 9.28124C17.3248 9.50624 14.5686 14.8219 8.99981 14.8219ZM1.85605 8.99999C2.4748 10.0406 4.89356 13.5562 8.99981 13.5562C13.1061 13.5562 15.5248 10.0406 16.1436 8.99999C15.5248 7.95936 13.1061 4.44374 8.99981 4.44374C4.89356 4.44374 2.4748 7.95936 1.85605 8.99999Z"
                                    fill="" />
                                    <path
                                    d="M9 11.3906C7.67812 11.3906 6.60938 10.3219 6.60938 9C6.60938 7.67813 7.67812 6.60938 9 6.60938C10.3219 6.60938 11.3906 7.67813 11.3906 9C11.3906 10.3219 10.3219 11.3906 9 11.3906ZM9 7.875C8.38125 7.875 7.875 8.38125 7.875 9C7.875 9.61875 8.38125 10.125 9 10.125C9.61875 10.125 10.125 9.61875 10.125 9C10.125 8.38125 9.61875 7.875 9 7.875Z"
                                    fill="" />
                                </svg>
                            </button>
                            <button class="hover:text-primary" wire:click="showConfirmation({{ $brand->id }})">
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                    d="M13.7535 2.47502H11.5879V1.9969C11.5879 1.15315 10.9129 0.478149 10.0691 0.478149H7.90352C7.05977 0.478149 6.38477 1.15315 6.38477 1.9969V2.47502H4.21914C3.40352 2.47502 2.72852 3.15002 2.72852 3.96565V4.8094C2.72852 5.42815 3.09414 5.9344 3.62852 6.1594L4.07852 15.4688C4.13477 16.6219 5.09102 17.5219 6.24414 17.5219H11.7004C12.8535 17.5219 13.8098 16.6219 13.866 15.4688L14.3441 6.13127C14.8785 5.90627 15.2441 5.3719 15.2441 4.78127V3.93752C15.2441 3.15002 14.5691 2.47502 13.7535 2.47502ZM7.67852 1.9969C7.67852 1.85627 7.79102 1.74377 7.93164 1.74377H10.0973C10.2379 1.74377 10.3504 1.85627 10.3504 1.9969V2.47502H7.70664V1.9969H7.67852ZM4.02227 3.96565C4.02227 3.85315 4.10664 3.74065 4.24727 3.74065H13.7535C13.866 3.74065 13.9785 3.82502 13.9785 3.96565V4.8094C13.9785 4.9219 13.8941 5.0344 13.7535 5.0344H4.24727C4.13477 5.0344 4.02227 4.95002 4.02227 4.8094V3.96565ZM11.7285 16.2563H6.27227C5.79414 16.2563 5.40039 15.8906 5.37227 15.3844L4.95039 6.2719H13.0785L12.6566 15.3844C12.6004 15.8625 12.2066 16.2563 11.7285 16.2563Z"
                                    fill="" />
                                    <path
                                    d="M9.00039 9.11255C8.66289 9.11255 8.35352 9.3938 8.35352 9.75942V13.3313C8.35352 13.6688 8.63477 13.9782 9.00039 13.9782C9.33789 13.9782 9.64727 13.6969 9.64727 13.3313V9.75942C9.64727 9.3938 9.33789 9.11255 9.00039 9.11255Z"
                                    fill="" />
                                    <path
                                    d="M11.2502 9.67504C10.8846 9.64692 10.6033 9.90004 10.5752 10.2657L10.4064 12.7407C10.3783 13.0782 10.6314 13.3875 10.9971 13.4157C11.0252 13.4157 11.0252 13.4157 11.0533 13.4157C11.3908 13.4157 11.6721 13.1625 11.6721 12.825L11.8408 10.35C11.8408 9.98442 11.5877 9.70317 11.2502 9.67504Z"
                                    fill="" />
                                    <path
                                    d="M6.72245 9.67504C6.38495 9.70317 6.1037 10.0125 6.13182 10.35L6.3287 12.825C6.35683 13.1625 6.63808 13.4157 6.94745 13.4157C6.97558 13.4157 6.97558 13.4157 7.0037 13.4157C7.3412 13.3875 7.62245 13.0782 7.59433 12.7407L7.39745 10.2657C7.39745 9.90004 7.08808 9.64692 6.72245 9.67504Z"
                                    fill="" />
                                </svg>
                            </button>
                        </div>
                        </td>
                    </tr>
                @endforeach    
            </tbody>
          </table>
        </div>
    </div>
    <!-- Confirmation Modal -->
    <div x-data="{ showConfirmationModal: @entangle('showConfirmationModal') }">
        <div x-show="showConfirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-4 rounded shadow-md">
                <p>Are you sure you want to delete?</p>
                <div class="mt-4 flex justify-end">
                    <button x-on:click="showConfirmationModal = false" class="px-4 py-2 text-gray-500 hover:text-gray-700">
                        Cancel
                    </button>
                    <button x-on:click="showConfirmationModal = false;" wire:click="deleteUserData({{$itemID}})" class="px-4 py-2 ml-2 bg-danger text-white hover:bg-red-700">
                        Confirm Delete
                    </button>
                </div>
            </div>
        </div>
    </div>   
    <!-- end Confirmation Modal -->
    <div x-data="{ showEditModal: @entangle('showEditModal') }">
        <div x-show="showEditModal">
            <div style="background-color: rgba(0, 0, 0, .5)" class="mx-auto absolute top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                <div class="container mx-auto rounded p-4 mt-2 overflow-y-auto w-full xl:w-1/2">
                    <div class="bg-white rounded px-8 py-8">
                        <!-- Alerts Item -->
                        @if (session()->has('message'))
                            <div class="grid grid-cols-1 gap-4 mb-4">
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
                        <h1 class="font-bold text-2xl mb-3">Edit brand</h1>
                        <div class="modal-body">
                            <form wire:submit.prevent="edit">
                                <div class="p-6.5">
                                  <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                                    <div class="w-full xl:w-1/1">
                                      <label class="mb-2.5 block text-black dark:text-white">
                                        Title
                                      </label>
                                      <input wire:model="editTitle" type="text" 
                                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                        @error('editTitle')
                                            <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                  </div>
                                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                                        <div class="w-full xl:w-1/1">
                                            <label class="mb-2.5 block text-black dark:text-white">
                                            Status 
                                            </label>
                                            <div class="relative z-20 bg-transparent dark:bg-form-input">
                                            <select wire:model="editStatus"
                                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                                <option value="">Select status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            @error('editStatus')
                                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                            @enderror 
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="inline-flex items-center justify-center rounded-md border border-primary py-4 px-10 text-center font-medium text-primary hover:bg-opacity-90 lg:px-8 xl:px-10">
                                        Update
                                    </button>
                                    
                                    <a  href="javascript:void(0)" wire:click="closeEditCategory()" class="inline-flex items-center justify-center rounded-md border border-primary py-4 px-10 text-center font-medium text-primary hover:bg-opacity-90 lg:px-8 xl:px-10">
                                        Close
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
