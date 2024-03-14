<div class="page-content container container-plus">
    <!-- page header and toolbox -->
    <div class="page-header pb-2">
        <h1 class="page-title text-primary-d2 text-150">
            สินค้า
            <small class="page-info text-secondary-d2 text-nowrap">
                <i class="fa fa-angle-double-right text-80"></i>
                ตารางแสดงยอดการขายสินค้า Geruns
            </small>
        </h1>


    </div>
    <hr />
    <!-- include file content-->
    <div class="row mt-3" id="div-show-data">
        <div class="col-12">
            <div id="results"></div>
            <form id="frm_show_data" autocomplete="off">
                <div class="card dcard overflow-hidden">
                    <div class="card-body px-1 px-md-3">
                        <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
                            <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
                                ตารางแสดงยอดการขายสินค้า Geruns
                            </h3>

                            <div class="pos-rel ml-sm-auto mr-sm-2 order-last order-sm-0">
                                <!-- copy -->
                                <button type="button" data-toggle="modal" data-target="#aside-search" class="btn btn-warning px-3 d-block w-100 text-95 border-2 brc-black-tp10">
                                    <i class="fa fa-search mr-1"></i>
                                    ค้นหาข้อมูล
                                </button>
                                <!-- สิ้นสุด copy -->
                            </div>
                        </div>
                        <div class="radius-1 table-responsive" style="min-height:300px;">

                            <table id="simple-table" class="mb-0 table table-striped table-bordered  brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
                                <thead class="text-white-tp3 bgc-primary text-90 border-b-1 brc-transparent">
                                    <tr>
                                        <th class="text-center">
                                            ที่
                                        </th>
                                        <th class="text-center">
                                            รายการ
                                        </th>
                                        <th class="text-center">
                                            สถานะการใช้งาน
                                        </th>

                                        <th class="text-center"></th>
                                    </tr>
                                </thead>

                                <tbody class="mt-1" id="show_data">

                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
                <div class="center text-center mt-3 d-flex shadow-sm border-1 brc-dark-l3 radius-1 bgc-white p-2 flex-wrap" align="center">
                    <div class="d-flex align-items-center justify-content-center mt-md-0 mx-auto flex-grow-1 flex-md-grow-0 my-1">
                        <span id="show_state" class="d-inline-block text-grey-d2"></span>
                        <select id="qpage" name="qpage" class="ace-select ml-5 no-border angle-down brc-h-blue-m3 w-auto pr-45 text-secondary-d3">
                            <option value="7">แสดง 7 </option>
                            <option value="10">แสดง 10 </option>
                            <option value="20">แสดง 20 </option>
                            <option value="50">แสดง 50 </option>
                            <option value="100">แสดง 100 </option>
                            <option value="150">แสดง 150 </option>
                            <option value="300">แสดง 300 </option>
                            <option value="500">แสดง 500 </option>
                        </select>
                    </div>
                    <div class="border-l-1 mx-2 brc-grey-l2 d-none d-md-block"></div>
                    <div class="border-b-1 my-2 brc-grey-l3 d-md-none w-100"></div>
                    <!-- pagination -->
                    <div class="d-flex align-items-center justify-content-center mt-md-0 mx-auto flex-grow-1 flex-md-grow-0 my-1">
                        <ul id="pagination" class="pagination">
                        </ul>
                    </div>
                    <!-- pagination -->
                    <div class="border-l-1 mx-2 brc-grey-l2 d-none d-md-block"></div>
                    <div class="border-b-1 my-2 brc-grey-l3 d-md-none w-100"></div>


                    <div class="d-flex align-items-center justify-content-center mt-md-0 mx-auto flex-grow-1 flex-md-grow-0 my-1">
                        <span class="text-grey-m1 text-95">
                            ไปที่หน้า
                        </span>

                        <input type="text" id="page" name="page" class="form-control form-control-sm w-6 text-center ml-2 mr-2px px-1" value="1" />
                        <span id="total_page"></span>

                    </div>
                </div>
            </form>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <!-- include file content-->

    <!-- ฟอร์ม popup สลับข้อมูล -->
    <div class="modal fade" id="dialog-sort" data-backdrop-bg="bgc-white" tabindex="-1" role="dialog" data-blur="true" aria-labelledby="dangerModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content brc-primary-m2 shadow">
                <div class="modal-header py-2 bgc-primary-tp1 border-0  radius-t-1">
                    <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder">
                        <i class="fa fa-sort text-white-d1 mr-1 p-2 w-4"></i> ฟอร์มสลับตำแหน่ง
                    </h5>

                    <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-150">&times;</span>
                    </button>
                </div>
                <!-- form สลับตำแหน่งข้อมูล -->
                <form id="frm_sort" name="frm_sort">
                    <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                        <div class="align-items-top mr-2 mr-md-5">

                            <div class="form-group row">
                                <div class="col-sm-4 col-form-label text-sm-right pr-0">
                                    หัวข้อที่จะย้าย :
                                </div>

                                <div class="col-sm-8 pr-0 pr-sm-3">
                                    <select class="form-control col-9" id="oposition" name="oposition">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-form-label text-sm-right pr-0">
                                    รูปแบบการย้าย :
                                </div>

                                <div class="col-sm-8 pr-0 pr-sm-3">
                                    <select class="form-control col-9" id="order_type" name="order_type" onChange="sh_nposition(this.value);">
                                        <option value='1'>สลับตำแหน่ง</option>
                                        <option value='2'>อยู่ก่อนหน้า</option>
                                        <option value='3'>อยู่ด้านหลัง</option>
                                        <option value='4'>ตำแหน่งแรก</option>
                                        <option value='5'>ตำแหน่งสุดท้าย</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="dnposition">
                                <div class="col-sm-4 col-form-label text-sm-right pr-0">
                                    หัวข้ออ้างอิง :
                                </div>

                                <div class="col-sm-8 pr-0 pr-sm-3">
                                    <select class="form-control col-9" id="nposition" name="nposition">
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer bgc-default-l5">
                        <button type="button" onclick="sort();" class="btn px-4 btn-blue" id="id-danger-yes-btn" data-dismiss="modal">
                            บันทึก
                        </button>
                        <button type="reset" class="btn px-4 btn-light-grey" data-dismiss="modal">
                            ยกเลิก
                        </button>
                    </div>
                </form>
                <!-- form สลับตำแหน่งข้อมูล -->

            </div>
        </div>
    </div>
    <!-- สิ้นสุดฟอร์มสลับข้อมูล-->
    <!-- form aside ค้นหาข้อมูล-->
    <form id="frm-search" name="frm-search" onsubmit="return false;">
        <div class="modal" id="aside-search" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content shadow border-0 radius-0">

                    <div class="modal-header p-0 radius-0 border-none border-t-3 brc-primary-m1 shadow-sm">
                        <h5 class="flex-grow-1 text-blue-d1 text-120 py-3 ml-3 mb-0">
                            <i class="fas fa-search text-secondary-m1"></i>
                            ค้นหาข้อมูลโดยละเอียด
                        </h5>

                        <a href="#" class="close m-0 border-l-1 brc-grey-m4" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>

                    <div class="modal-body" data-ace-scroll='{"smooth": true}'>
                        <div class="form-group row">
                            <div class="col-sm-12 col-form-label pr-0">
                                คำนำหน้า :
                            </div>

                            <div class="col-sm-12 pr-0 pr-sm-3">
                                <input type="text" class="form-control sfrm" id="s_title" name="s_title" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-form-label pr-0">
                                สถานะการใช้งาน :
                            </div>

                            <div class="col-sm-12 pr-0 pr-sm-3">
                                <select class="form-control col sfrm" name="s_status" id="s_status" data-placeholder="Click to Choose...">
                                    <option value="">กรุณาเลือกสถานะการใช้งาน</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer bgc-secondary-l4 brc-secondary-l2 justify-content-center">
                        <button type="button" onclick="show_data2();" class="btn btn-info btn-a-blue btn-h-blue px-4 border-2" data-dismiss="modal">
                            <i class="fas fa-search"></i> ค้นหาข้อมูล
                        </button>
                        <button type="reset" class="btn btn-warning btn-text-white btn-a-yellow btn-h-yellow px-4 border-2">
                            <i class="fa fa-brush"></i> ล้างข้อมูล
                        </button>
                    </div>

                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div><!-- .ace-aside -->
    </form>
    <!-- สิ้นสุด form aside-->

</div>