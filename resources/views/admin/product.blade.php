<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cards - Windmill Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('css/tailwind.output.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{asset('js/init-alpine.js')}}"></script>
  </head>
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen}"
    >
      <!-- Desktop sidebar -->
      @include('admin.layout.header')
        <main class="h-full pb-16 overflow-y-auto">
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Sản Phẩm
            </h2>
            <!-- List product -->
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3"><a href="{{route('admin-product')}}"> Danh sách sản phẩm</a></th>
                      <th class="px-4 py-3"><a href="{{route('admin-product-hot')}}"> Sản phẩm bán chạy </a></th>
                      <th class="px-4 py-3"><a href="{{route('admin-product-soldout')}}"> Sản phẩm bán hết </a></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Danh sách sản phẩm
            </h4>
            <div class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a
                class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue"
                href="{{route('admin-product-add')}}"
              >
                Thêm sản phẩm
              </a>
            </div>
            
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">id</th>
                      <th class="px-4 py-3">Sản Phẩm</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">Số lượng</th>
                      <th class="px-4 py-3">Date</th>
                      <th class="px-4 py-3">Sửa</th>
                      <th class="px-4 py-3">Xóa</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                  @foreach($products as $product)
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">
                        {{$product->id}}
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <!-- Avatar with inset shadow -->
                          <div
                            class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                          >
                            <img
                              class="object-cover w-full h-full rounded-full"
                              src="{{ asset('images/home/'.$product->image) }}"
                              alt=""
                              loading="lazy"
                            />
                            <div
                              class="absolute inset-0 rounded-full shadow-inner"
                              aria-hidden="true"
                            ></div>
                          </div>
                          <div>
                            <p class="font-semibold">{{ $product->name }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                            {{ number_format($product->price) }} VNĐ
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-xs">
                        @if($product->status == 'active')
                        <span
                          class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                        >
                          Còn hàng
                        </span>
                        @else
                        <span
                          class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100"
                        >
                          Hết hàng
                        </span>
                        @endif
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ $product->quantity }}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ $product->created_at }}
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <span
                          class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                        >
                          <a href="{{ route('admin-product-edit',$product)  }}">Sửa</a>
                        </span>
                      </td>
                      <td class="px-4 py-3 text-xs">
                      <form action="{{ route('admin-product-delete',$product) }}" method="post">
                        <span
                          class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700"
                        >
                            @csrf
                            @method('delete')
                            <button type="submit">Xóa</button>
                          <!-- <a href="{{ route('admin-product-delete',$product) }}">Xóa</a> -->
                        </span>
                      </form>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
              >
                <span class="flex items-center col-span-3">
                  Showing 21-30 of 100
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                      <li>
                        <button
                          class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                          aria-label="Previous"
      
                        >
                          <svg
                            aria-hidden="true"
                            class="w-4 h-4 fill-current"
                            viewBox="0 0 20 20"
                          >
                            <path
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"
                              fill-rule="evenodd"
                            ></path>
                          </svg>
                        </button>
                      </li>
                      <li>
                        
                        <?php for($i=1;$i<=$number;$i++): ?>
                        <a class="page-link" href="{{route('admin-process-page')}}?page=<?php echo $i ?>">
                        <button
                          class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                        >
                          {{ $i }}
                        </button>
                        </a>
                        <?php endfor ?>
                      </li>
                      
                      <li>
                        <button
                          class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                          aria-label="Next"
                        >
                          <svg
                            class="w-4 h-4 fill-current"
                            aria-hidden="true"
                            viewBox="0 0 20 20"
                          >
                            <path
                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                              clip-rule="evenodd"
                              fill-rule="evenodd"
                            ></path>
                          </svg>
                        </button>
                      </li>
                    </ul>
                  </nav>
                </span>
              </div>
            </div>
          </div>

        </main>
      </div>
    </div>
  </body>
</html>
