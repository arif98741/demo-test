<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order-Invoice</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <!------custom css-------->
    <link href="{{asset('frontend/css/custom.css')}}" rel="stylesheet" />
    <!------bootstrap 5 -------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font awesome--->
<script src="https://kit.fontawesome.com/49f07afdff.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">
        <!---invoice header---->
        <div class="bg-primary d-block" style="height: 50px;">

        </div>
        <div class="my-2 d-inline">
            <h2 class="bg-secondary d-inline text-white py-1 px-5">Invoice</h2>
        </div>
       <div class="float-end">
        <a class="navbar-brand fw-bold" href="{{url('/')}}"><span class="logo-style">Rovers</span></a>
       </div>
       <br>
       <div class="row mt-4">
        <div class="col-md-4">
            <p><b>Invoice Detail</b></p>
            <small><b>Issue Date</b> : 
                {{date('d-m-Y',strtotime($orders->created_at))}}
              </small>
              <br>
              <small><b>Invoice No </b> : {{$orders->id}}</small>
        </div>
        <div class="col-md-4">
            <p><b>Invoice To</b></p>
            <small>{{$orders->fname}}  {{$orders->lname}}</small>
            <small></small>
            <br>
            <small>
                <i class="fa-solid fa-location-dot me-2"></i>{{$orders->address1}},{{$orders->address2}},
                {{ $orders->city}},
                {{$orders->state}},
                {{$orders->country}}
            </small>
            <br>
            <small> <i class="fa-solid fa-phone me-2"></i> {{$orders->phone}}</small>
            <br>
            <small> <i class="fa-solid fa-envelope me-2"></i> {{$orders->email}}</small>
        </div>
        <div class="col-md-4">
            <p><b><i class="fa-solid fa-location-dot"></i> 66 victoria college Road,
               <br> Comilla </b></p>
            <small><i class="fa-solid fa-phone me-2"></i> +01609298896</small>
            <br>
            <small><i class="fa-solid fa-envelope me-2"></i> rovers@gmail.com</small>
            <br>
            <small><i class="fa-solid fa-earth-americas me-2"></i>www.rovers.com</small>
        </div>
       </div>


       <div class="mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Item Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($orders->orderItems as $row)
                    <tr>
                        <td><img src="{{asset('assets/uploads/products/'.$row->products->image)}}" alt="image" width="100px"></td>
                        <td>{{$row->products->name}}</td>
                        <td>BDT{{$row->products->selling_price}}</td>
                        <td>{{$row->qty}}</td>
                        <td>BDT{{$row->products->selling_price*$row->qty}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row mt-5">
            <div class="col-md-5">
                <p class="text-primary"><b>Payment method</b></p>
                <hr>
                <small><b>PaymentMethod</b> : {{$orders->payment_mode}}</small>
                <br>
                <small><b>Order No</b> : {{$orders->id}}</small>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-4">
                <p><b>Subtotal </b> : {{$orders->total_price}}</p>
                <p><b>Taxes </b> : </p>
                <p><b>Discount </b> : </p>
                <p class="bg-primary p-3 text-white">Total :  <small class="float-end">{{$orders->total_price}}</small></p>
            </div>
            <div class="bg-dark text-white mt-4 d-block py-2 text-center" style="height: 50px;">
                <small class="me-3"><i class="fa-solid fa-phone me-2  text-primary"></i> +01609298896
                </small>
                <small  class="me-3">
                <i class="fa-solid fa-envelope me-2 text-primary"></i> rovers@gmail.com
                </small>
                <small  class="me-3"><i class="fa-solid fa-earth-americas me-2 text-primary"></i>www.rovers.com
                </small>
            </div>
          <div class="bg-primary d-block" style="height: 50px;">
          </div>
      
       

    </div>
    </div>
    
</body>
</html>