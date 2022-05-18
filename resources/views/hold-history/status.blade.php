@if ($hold->holds_status !='start')
<div class="col-12 col-md-12">

    <div class="form-group row pl-3">

        <label for="inputEmail3" class="col-form-label">เลือกการชำระเงิน / สถานะ : </label>
        <div class="col-12  col-md-4">

            <select name="status" id="status" class="form-control input-block-level" style="width: 100%" disabled>
                <option value="start"> 1. อยู่ระหว่างการตกลง </option>


                @if (substr($hold->holds_status, 0, 1)=='p')
                <option value="p2" @if ($hold->holds_status =='p2')
                    selected
                    @endif> 2. สั่งซื้อจ่ายล่วงหน้าและเก็บเงินแล้ว -
                    ออกบิล/กรอกข้อมูลการจัดส่งข้อมูลการจัดส่ง</option>
                <option value='p3' @if ($hold->holds_status =='p3')
                    selected
                    @endif > 3. เก็บหลักฐานการจ่ายเงิน</option>
                <option value='p4' @if ($hold->holds_status =='p4')
                    selected
                    @endif> 4. จัดส่งสินค้า</option>
                <option value='p5' @if ($hold->holds_status =='p5')
                    selected
                    @endif> 5. แจ้งเลขขนส่งให้ลูกค้า</option>
                <option value='p6' @if ($hold->holds_status =='p6')
                    selected
                    @endif> 6. อยู่ระหว่างการจัดส่งสินค้า</option>
                <option value='p7' @if ($hold->holds_status =='p7')
                    selected
                    @endif> 7. ลูกค้าได้รับสินค้า</option>
                <option value='p8' @if ($hold->holds_status =='p8')
                    selected
                    @endif> 8. คอมเม้นต์</option>
                <option value='p9' @if ($hold->holds_status =='p9')
                    selected
                    @endif> 9. โอนเงินให้เจ้าของผลิตภัณท์</option>
                <option value='p10' @if ($hold->holds_status =='p10')
                    selected
                    @endif> 10. เก็บหลักฐานการโอนเงิน</option>
                <option value='p11' @if ($hold->holds_status =='p11')
                    selected
                    @endif> 11. ทำรายการสำเร็จ</option>
                @endif

                @if ( substr($hold->holds_status, 0, 1) =='n')
                <option value='n2' @if ($hold->holds_status =='n2')
                    selected
                    @endif> 2. สั่งซื้อเก็บเงินปลายทาง - กรอกข้อมูลการจัดส่ง </option>
                <option value='n3' @if ($hold->holds_status =='n3')
                    selected
                    @endif> 3. จัดส่งสินค้า </option>
                <option value='n4' @if ($hold->holds_status =='n4')
                    selected
                    @endif> 4. แจ้งเลขขนส่งให้ลูกค้า </option>
                <option value='n5' @if ($hold->holds_status =='n5')
                    selected
                    @endif> 5. อยู่ระหว่างการจัดส่งสินค้า </option>
                <option value='n6' @if ($hold->holds_status =='n6')
                    selected
                    @endif> 6. ลูกค้าได้รับสินค้า - พร้อมจ่ายเงิน</option>
                <option value='n7' @if ($hold->holds_status =='n7')
                    selected
                    @endif> 7. คอมเม้นต์ </option>
                <option value='n8' @if ($hold->holds_status =='n8')
                    selected
                    @endif> 8. โอนเงินให้เจ้าของผลิตภัณท์ </option>
                <option value='n9' @if ($hold->holds_status =='n9')
                    selected
                    @endif> 9. เก็บหลักฐานการโอนเงิน </option>
                <option value='n10' @if ($hold->holds_status =='n10')
                    selected
                    @endif> 10. ทำรายการสำเร็จ </option>
                @endif

            </select>
        </div>
        <div class="input-group-append col-12 col-md-3  pt-xl-0   pt-2  text-center">

            @if ($hold->holds_status !='start' || $hold->holds_status =='n10' || $hold->holds_status =='p11' )
            @if ($hold->holds_status =='n10' || $hold->holds_status =='p11' )

            @else
            <button type="button" class="btn btn-warning" onclick="backstatus()"><i class="fas fa-arrow-left"></i>
                กลับไปสถานะก่อนหน้า</button>
            @endif

            @endif
            @if ($hold->holds_status =='n10' || $hold->holds_status =='p11' )

            @else
            <button class="btn btn-primary btn-block" onclick="changestatus()" id="btn-changestatus">สถานะถัดไป <i
                    class="fas fa-arrow-right"></i></button>
            @endif

        </div>
       
       
    </div>
    
</div>

@else

<div class="col-12 col-md-12">

    <div class="form-group row pl-3">
        <label for="inputEmail3" class="col-form-label">เลือกการชำระเงิน / สถานะ : </label>
        <div class="col-12  col-md-4">
            <select name="status" id="status" class="form-control input-block-level" style="width: 100%">
                <option value="start"> 1. อยู่ระหว่างการตกลง </option>
                <option value="p2"> 2. สั่งซื้อจ่ายล่วงหน้าและเก็บเงินแล้ว -
                    ออกบิล/ข้อมูลการจัดส่ง</option>
                <option value="n2"> 2. สั่งซื้อเก็บเงินปลายทาง - ข้อมูลการจัดส่ง </option>
            </select>
        </div>
        <div class="input-group-append col-md-3  pt-xl-0   pt-2  text-center">
            <button class="btn btn-primary btn-block" onclick="changestatus()"
                id="btn-changestatus">เลือกการชำระเงิน</button>
        </div>
    </div>

</div>


@endif
