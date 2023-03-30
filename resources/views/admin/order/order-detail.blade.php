<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hóa Đơn - Windmill Dashboard</title>
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
            <div class="container grid px-6 mx-auto">
                <h2
                class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
                >
                <form action="{{route('admin-order-detail-update',$transaction)}}" method="post">
                  @csrf
                Chi tiết hoá Đơn
                </h2>
                <div class="grid gap-6 mb-8 md:grid-cols-2">
              <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                  Thông tin khách hàng
                </h4>
                
                <div
                  class="justify-center mt-4 text-sm text-gray-600 dark:text-gray-400"
                >
                  <!-- Chart legend -->
                  
                  <div class="flex items-center">
              
                    <span>Họ và tên: {{$transaction->re_name}}</span>
                  </div>
                  <div class="flex items-center">
              
                    <span>Email: {{$transaction->re_email}}</span>
                  </div>
                  <div class="flex items-center">
                
                    <span>Số điện thoại: {{$transaction->re_phone}}</span>
                  </div>
                  <div class="flex items-center">
                    
                    <span>Địa chỉ: {{$transaction->re_address}}</span>
                  </div>
                </div>
              </div>
              <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                  Thông tin đơn hàng
                </h4>
                <div
                  class="justify-center mt-4 text-sm text-gray-600 dark:text-gray-400"
                >
                  <!-- Chart legend -->
                  <div class="flex items-center">
                    <span>Mã hóa đơn: {{$transaction->id}}</span>
                  </div>
                  <div class="flex items-center">
                    <span>Ngày đặt: {{$transaction->created_at}}</span>
                  </div>
                </div>
              </div>
            </div>
            <!-- Table order -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                  >
                    <th class="px-4 py-3">ID</th> 
                    <th class="px-4 py-3">Mô tả</th>
                    <th class="px-4 py-3">Giá cả</th>
                    <th class="px-4 py-3">Số lượng</th>
                  </tr>
                </thead>
                <tbody
                  class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                >
                  @foreach($product as $item)
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm">
                      {{$item->id}}
                    </td>
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div
                          class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                        >
                          <img
                            class="object-cover w-full h-full rounded-full"
                            src="{{asset('images/home/'.$item->image)}}"
                            alt=""
                            loading="lazy"
                          />
                          <div
                            class="absolute inset-0 rounded-full shadow-inner"
                            aria-hidden="true"
                          ></div>
                        </div>
                        <div>
                          <p class="font-semibold">{{$item->name}}</p>
                          <p class="text-xs text-gray-600 dark:text-gray-400">
                            {{$item->size}}
                          </p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{number_format($item->price)}} VNĐ
                    </td>
                    <td class="px-4 py-3 text-xs">
                      {{$item->quantity}}
                    </td>
                  </tr>
                  @endforeach
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                  >
                    <th></th>
                    <th></th>
                    <th class="px-4 py-3">Tổng</th>
                    <td class="px-4 py-3 text-sm">
                      {{number_format($transaction->total_price)}} VNĐ
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          @if($transaction->status == 'pending')
          <button
            class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            type="submit"
          >
            Duyệt đơn hàng
          </button>
          @endif

        </form>
          </div>
        </main>
    </div>
  </body>
</html>
