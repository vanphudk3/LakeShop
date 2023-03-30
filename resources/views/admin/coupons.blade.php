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
              Coupons
            </h2>
            <!-- List product -->
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Danh sách mã giảm giá
            </h4>
            <div class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a
                class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue"
                href="{{route('admin-insert-coupon')}}"
              >
                Thêm mã giảm giá
              </a>
            </div>
            @if(session()->has('success'))
            <div class="px-4 py-3 mb-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
              <strong class="font-bold">Success!</strong>
              <span class="block sm:inline">{{session()->get('success')}}</span>
            </div>
            @endif
            
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">id</th>
                      <th class="px-4 py-3">Tên mã giảm</th>
                      <th class="px-4 py-3">Mã giảm</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">Số phần trăm (%) or số tiền giảm (vnđ)</th>
                      <th class="px-4 py-3">Date</th>
                      <th class="px-4 py-3">Xóa</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                    @foreach($coupon as $coupons) 
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">
                        {{$coupons->id}}
                      </td>
                      <td class="px-4 py-3">
                        {{$coupons->name}}
                      </td>
                      <td class="px-4 py-3 text-xs">
                        {{$coupons->code}}
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <span
                          class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                        >
                        @if($coupons->status == 1)
                          Hiển thị
                        @else
                          Ẩn
                        @endif
                        </span>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        @if($coupons->value==1)
                          {{$coupons->discount}} %
                        @else
                          {{$coupons->discount}}.000 VNĐ
                        @endif
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{$coupons->created_at}}
                      </td>
                      <td class="px-4 py-3 text-xs">
                      <form action="{{ route('admin-delete-coupon',$coupons) }}" method="post">
                        <span
                          class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700"
                        >
                            @csrf
                            @method('delete')
                            <button type="submit">Xóa</button>
                        </span>
                      </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>  
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
