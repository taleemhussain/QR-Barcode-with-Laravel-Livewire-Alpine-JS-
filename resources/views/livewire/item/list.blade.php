<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
    <div class="container mx-auto px-5 bg-white">
      <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
      <h2 class="text-title-md2 font-bold text-black dark:text-white">
        Assign Products
      </h2>

      <nav>
        <ol class="flex items-center gap-2">
          <li class="font-medium">
          </li>
        </ol>
      </nav>
    </div>
    <!-- Breadcrumb End -->  
      <div class="flex lg:flex-row flex-col-reverse shadow-lg">
          <!-- left section -->
          <div class="w-full lg:w-3/5 min-h-screen shadow-lg">
            <!-- categories -->
            <div class="mt-5 flex flex-col gap-6 xl:flex-row px-5">
              <div class="w-full xl:w-1/2">
                <label class="mb-2.5 block text-black dark:text-white">
                  Search
                </label>
                  <input wire:model="title" type="text" placeholder="Search by product"
                    class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
              </div>
                <div class="w-full xl:w-1/2">
                  <label class="mb-2.5 block text-black dark:text-white">
                    Category
                  </label>
                  <select wire:model="category_id"
                    class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    <option value="">Select category</option>
                    @foreach($categories as $category)
                      <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                  </select> 
                </div>

                <div class="w-full xl:w-1/2">
                  <label class="mb-2.5 block text-black dark:text-white">
                    Brand 
                  </label>
                  <select wire:model="brand_id"
                      class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                      <option value="">Select brand</option>
                      @foreach($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->title}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <!-- end categories -->
            
            <!-- products -->
            <div class="grid grid-cols-2 gap-4 gap-6 px-5 mt-5 overflow-y-auto  w-full">
              @foreach ($products as $product)
                <div class=" cursor-pointer px-3 py-3 flex flex-col border border-gray-200 rounded-md h-32 justify-between" wire:click="addToCart({{ $product->id }},1)">
                  <div>
                    <div class="font-bold text-gray-800">{{$product->title}}</div>
                    <span class="font-light text-sm text-gray-400">In stock: {{$product->quantity}}</span>
                  </div>
                  <div class="flex flex-row justify-between items-center">
                    <span class="self-end font-bold text-lg text-yellow-500">${{ number_format($product->price, 2) }}</span>
                    @if($product->image)
                      <img src="{{ asset('storage/' . $product->image) }}" class=" h-14 w-14 object-cover rounded-md" alt="">
                    @else
                      <img src="{{ asset('storage/' . '4sBZCVosk6jeSB1K.jpg') }}" class=" h-14 w-14 object-cover rounded-md" alt="">
                    @endif
                  </div>
                </div>
              @endforeach
              <!-- Add more items following a similar structure -->
            </div>
            
            <!-- end products -->
          </div>
          <!-- end left section -->
          <!-- right section -->
          <div class="w-full lg:w-2/5">
            {{-- <form wire:submit.prevent=""> --}}
            <!-- header -->
            <div class="w-full items-center justify-between px-5 mt-5">
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
                  <!-- Alerts Item -->
                  <!-- Alerts Item -->
                  @if (session()->has('error'))
                  <div class="grid grid-cols-1 gap-4 mb-4">
                      <div class="flex w-full border-l-6 border-[#F87171] bg-[#F87171] bg-opacity-[15%] dark:bg-[#1B1B24] px-7 py-3 shadow-md dark:bg-opacity-30 md:p-9">
                          <div class="mr-5 flex h-9 w-full max-w-[36px] items-center justify-center rounded-lg bg-[#F87171]">
                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M6.4917 7.65579L11.106 12.2645C11.2545 12.4128 11.4715 12.5 11.6738 12.5C11.8762 12.5 12.0931 12.4128 12.2416 12.2645C12.5621 11.9445 12.5623 11.4317 12.2423 11.1114C12.2422 11.1113 12.2422 11.1113 12.2422 11.1113C12.242 11.1111 12.2418 11.1109 12.2416 11.1107L7.64539 6.50351L12.2589 1.91221L12.2595 1.91158C12.5802 1.59132 12.5802 1.07805 12.2595 0.757793C11.9393 0.437994 11.4268 0.437869 11.1064 0.757418C11.1063 0.757543 11.1062 0.757668 11.106 0.757793L6.49234 5.34931L1.89459 0.740581L1.89396 0.739942C1.57364 0.420019 1.0608 0.420019 0.740487 0.739944C0.42005 1.05999 0.419837 1.57279 0.73985 1.89309L6.4917 7.65579ZM6.4917 7.65579L1.89459 12.2639L1.89395 12.2645C1.74546 12.4128 1.52854 12.5 1.32616 12.5C1.12377 12.5 0.906853 12.4128 0.758361 12.2645L1.1117 11.9108L0.758358 12.2645C0.437984 11.9445 0.437708 11.4319 0.757539 11.1116C0.757812 11.1113 0.758086 11.111 0.75836 11.1107L5.33864 6.50287L0.740487 1.89373L6.4917 7.65579Z"
                                fill="#ffffff" stroke="#ffffff"></path>
                            </svg>
                          </div>
                          <div class="w-full">
                          <h5 class="mb-3 text-lg font-bold text-black dark:text-[#34D399]">
                              <p class="text-base leading-relaxed text-body">
                                  {{ session('error') }}
                              </p>
                          </h5>
                          </div>
                      </div>
                  </div> 
                  @endif
                  <!-- Alerts Item -->
                <div class="w-full xl:w-1/1">
                  <label class="mb-2.5 block text-black dark:text-white">
                    Select user 
                  </label>
                  <div class="relative z-20 bg-transparent dark:bg-form-input">
                    <select wire:model="user_id"
                      class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                      <option value="">Select user</option>
                      @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                    </select>
                    @error('user_id')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror 
                  </div>
                </div> 
            </div>
            <div class="flex flex-row items-center justify-between px-5 mt-5">
              <div class="text-xl">Item</div>
              <div class="font-semibold">
                <span class="px-4 py-2 rounded-md bg-red-100 text-red-500">Quantity</span>
                <span class="px-4 py-2 rounded-md bg-gray-100 text-gray-800">Action</span>
              </div>
            </div>
            <!-- end header -->
            <!-- order list -->
            <div class="px-5 py-4 mt-5 overflow-y-auto h-64">
              @foreach ($selected_items as $item)               
                <div class="flex flex-row justify-between items-center mb-4">
                  <div class="flex flex-row items-center w-2/5">
                    @if($item->image)
                      <img src="{{ asset('storage/' . $item->image) }}" class=" h-14 w-14 object-cover rounded-md" alt="" width="50px">
                    @else
                      <img src="{{ asset('storage/' . '4sBZCVosk6jeSB1K.jpg') }}" class=" h-14 w-14 object-cover rounded-md" alt="" width="50px">
                    @endif
                    <span class="ml-4 font-semibold text-sm">{{$item->title}}</span>
                  </div>
                  <div class="w-32 flex justify-between">
                    <span class="font-semibold mx-4">
                       {{-- wire:model="cart.{{ $item['id'] }}.items.quantity" value="{{$cart[$item->id]['items']['quantity']}}" --}}
                       {{-- <input wire:model="cart.{{ $item['id'] }}.items.quantity" wire:keydown.enter="updateCartItem({{ $item['id'] }}, {{ $cart[$item['id']]['items']['quantity'] }})" type="text" 
                      class="w-full  h-10 rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />  --}}
                      <input type="text" x-data="{ productId: {{ $item['id'] }} }" x-init="
                      $refs.quantityInput.addEventListener('keydown', event => {
                          if (event.key === 'Enter') {
                              Livewire.emit('updateCartItem', productId, event.target.value);
                          }
                      });
                  " x-ref="quantityInput" value="{{ $cart[$item['id']]['items']['quantity'] }}" class="w-full  h-10 rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                  
              
                      @error('$quantity')
                          <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                      @enderror
                    </span>
                  </div>
                  <div class="font-semibold text-lg w-16 text-center">
                      <button class="hover:text-primary" wire:click="removeFromCart({{$item->id}})">
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
                </div>
              @endforeach  
            </div>
            
            <!-- end order list -->
            <!-- button pay-->
            <div class="px-5 mt-5">
              <div class="flex justify-between">
                <span></span>
                <button wire:click="clearCart()" class="text-right mb-2 border border-primary px-4 py-2 rounded-md">Clear cart</button>
            </div>
            
              <button wire:click="assignItem()" class="w-full px-4 py-4 rounded-md shadow-lg text-center bg-yellow-500 text-black font-semibold rounded-md border border-primary">
                Submit 
              </button>
            </div>
            <!-- end button pay -->
            {{-- </form> --}}
          </div>
          <!-- end right section -->
        </div>
    </div>
</div>
