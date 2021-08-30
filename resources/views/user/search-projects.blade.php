    @extends('user.layouts.master')

    @section('main-content')

    <section class="fr-list-product "
        style='background: url(https://marketplace.exertiowp.com/wp-content/uploads/2020/12/sz.png); background-position: center center; background-size: cover; background-repeat: no-repeat;'>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="fr-list-content">
                        <div class="fr-list-srch">
                            <h1>Project Search</h1>
                        </div>
                        <div class="fr-list-details">
                            <ul>
                                <li><a href="https://marketplace.exertiowp.com/">Home</a></li>
                                <li><a href="javascript:void(0);">Project Search</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="fr-list-side-bar section-padding bg-gray-light-color  actionbar_space">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-xs-12 col-sm-12 col-md-12 col-xl-4">
                    <div class="project-sidebar">
                        <div class="heading">
                            <h4>Search Filters</h4>
                            <a href="https://marketplace.exertiowp.com/project-search/">Clear Result</a>
                        </div>
                        <div class="project-widgets">
                            <form action="https://marketplace.exertiowp.com/project-search/">
                                <div class="panel panel-default">
                                    <div class="panel-heading active"> <a role="button" class=""
                                            data-bs-toggle="collapse" href="#search-widget"> Saerch by Keyword </a>
                                    </div>
                                    <div id="search-widget" class="panel-collapse collapse show" role="tabpanel">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="title"
                                                    placeholder="What are you looking for" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading active"> <a role="button" class=""
                                            data-bs-toggle="collapse" href="#category-widget"> Category </a> </div>
                                    <div id="category-widget" class="panel-collapse collapse show" role="tabpanel">
                                        <div class="panel-body">
                                            <ul class="main">
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="category[]" value="165" id="165" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="165">Apps Developements (2)</span>
                                                    <ul>
                                                        <li class="">
                                                            <div class="pretty p-icon p-thick p-curve">
                                                                <input type="checkbox" name="category[]" value="200"
                                                                    id="200" />
                                                                <div class="state p-warning">
                                                                    <i class="icon fa fa-check"></i>
                                                                    <label></label>
                                                                </div>
                                                            </div>
                                                            <span for="200">IOS (1)</span>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="category[]" value="22" id="22" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="22">Business (2)</span>
                                                    <ul>
                                                        <li class="">
                                                            <div class="pretty p-icon p-thick p-curve">
                                                                <input type="checkbox" name="category[]" value="203"
                                                                    id="203" />
                                                                <div class="state p-warning">
                                                                    <i class="icon fa fa-check"></i>
                                                                    <label></label>
                                                                </div>
                                                            </div>
                                                            <span for="203">Services (1)</span>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="category[]" value="17" id="17" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="17">Digital Marketing (1)</span>
                                                    <ul></ul>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="category[]" value="19" id="19" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="19">Video &amp; Animation (1)</span>
                                                    <ul></ul>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="category[]" value="164" id="164" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="164">Website Development (1)</span>
                                                    <ul></ul>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="category[]" value="18" id="18" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="18">Writing &amp; Translation (2)</span>
                                                    <ul></ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading active"> <a role="button" class=""
                                            data-bs-toggle="collapse" href="#price-widget"> Price </a> </div>
                                    <div id="price-widget" class="panel-collapse collapse show" role="tabpanel">
                                        <div class="panel-body">
                                            <div class="range-slider">
                                                <input type="text" class="services-range-slider" value="" data-min=""
                                                    data-max="1500" data-from="" data-to="" />
                                            </div>
                                            <div class="extra-controls">
                                                <input type="text" class="services-input-from form-control" value=""
                                                    name="price-min" />
                                                <input type="text" class="services-input-to form-control" value=""
                                                    name="price-max" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading active"> <a role="button" class="collapsed"
                                            data-bs-toggle="collapse" href="#skills-widget"> Filter by Skills </a>
                                    </div>
                                    <div id="skills-widget" class="panel-collapse collapse " role="tabpanel">
                                        <div class="panel-body">
                                            <ul class="main">
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="skill[]" value="113" id="113" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="113">Android Developer (2)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="skill[]" value="103" id="103" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="103">Artist (4)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="skill[]" value="105" id="105" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="105">Backend Developer (3)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="skill[]" value="248" id="248" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="248">Data Entry (3)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="skill[]" value="95" id="95" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="95">Designer (7)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="skill[]" value="94" id="94" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="94">Developer (5)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="skill[]" value="114" id="114" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="114">IOS Developer (3)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="skill[]" value="249" id="249" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="249">Logo Design (1)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="skill[]" value="102" id="102" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="102">Musician (1)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="skill[]" value="98" id="98" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="98">QA Speciallist (4)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="skill[]" value="101" id="101" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="101">Singer (1)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="skill[]" value="99" id="99" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="99">Support Agent (3)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="skill[]" value="100" id="100" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="100">Writter (3)</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading active"> <a role="button" class=""
                                            data-bs-toggle="collapse" href="#english-level-widget"> English Level </a>
                                    </div>
                                    <div id="english-level-widget" class="panel-collapse collapse show" role="tabpanel">
                                        <div class="panel-body">
                                            <ul class="main">
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="english-level[]" value="93"
                                                            id="93" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="93">Bilingual (1)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="english-level[]" value="167"
                                                            id="167" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="167">Fluent (4)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="english-level[]" value="91"
                                                            id="91" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="91">Native (3)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="english-level[]" value="92"
                                                            id="92" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="92">Professional (1)</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading active"> <a role="button" class="collapsed"
                                            data-bs-toggle="collapse" href="#languages-widget"> Languages </a> </div>
                                    <div id="languages-widget" class="panel-collapse collapse " role="tabpanel">
                                        <div class="panel-body">
                                            <ul class="main">
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="language[]" value="35" id="35" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="35">Arabic (5)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="language[]" value="34" id="34" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="34">Chinese (1)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="language[]" value="32" id="32" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="32">English (8)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="language[]" value="37" id="37" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="37">French (1)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="language[]" value="38" id="38" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="38">Japanese (3)</span>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="language[]" value="36" id="36" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="36">Spanish (4)</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading active"> <a role="button" class="collapsed"
                                            data-bs-toggle="collapse" href="#locations-widget"> Filter by Location </a>
                                    </div>
                                    <div id="locations-widget" class="panel-collapse collapse " role="tabpanel">
                                        <div class="panel-body">
                                            <ul class="main">
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="location[]" value="333" id="333" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="333">Australia (4)</span>
                                                    <ul>
                                                        <li class="">
                                                            <div class="pretty p-icon p-thick p-curve">
                                                                <input type="checkbox" name="location[]" value="334"
                                                                    id="334" />
                                                                <div class="state p-warning">
                                                                    <i class="icon fa fa-check"></i>
                                                                    <label></label>
                                                                </div>
                                                            </div>
                                                            <span for="334">Victoria (3)</span>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="location[]" value="335" id="335" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="335">Germany (1)</span>
                                                    <ul>
                                                        <li class="">
                                                            <div class="pretty p-icon p-thick p-curve">
                                                                <input type="checkbox" name="location[]" value="337"
                                                                    id="337" />
                                                                <div class="state p-warning">
                                                                    <i class="icon fa fa-check"></i>
                                                                    <label></label>
                                                                </div>
                                                            </div>
                                                            <span for="337">Hamburg (1)</span>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="location[]" value="345" id="345" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="345">UAE (2)</span>
                                                    <ul>
                                                        <li class="">
                                                            <div class="pretty p-icon p-thick p-curve">
                                                                <input type="checkbox" name="location[]" value="346"
                                                                    id="346" />
                                                                <div class="state p-warning">
                                                                    <i class="icon fa fa-check"></i>
                                                                    <label></label>
                                                                </div>
                                                            </div>
                                                            <span for="346">Abu Dhabi (1)</span>
                                                        </li>
                                                        <li class="">
                                                            <div class="pretty p-icon p-thick p-curve">
                                                                <input type="checkbox" name="location[]" value="349"
                                                                    id="349" />
                                                                <div class="state p-warning">
                                                                    <i class="icon fa fa-check"></i>
                                                                    <label></label>
                                                                </div>
                                                            </div>
                                                            <span for="349">Sharjah (1)</span>
                                                            <ul>
                                                                <li class="">
                                                                    <div class="pretty p-icon p-thick p-curve">
                                                                        <input type="checkbox" name="location[]"
                                                                            value="350" id="350" />
                                                                        <div class="state p-warning">
                                                                            <i class="icon fa fa-check"></i>
                                                                            <label></label>
                                                                        </div>
                                                                    </div>
                                                                    <span for="350">Riffa (1)</span>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="">
                                                    <div class="pretty p-icon p-thick p-curve">
                                                        <input type="checkbox" name="location[]" value="258" id="258" />
                                                        <div class="state p-warning">
                                                            <i class="icon fa fa-check"></i>
                                                            <label></label>
                                                        </div>
                                                    </div>
                                                    <span for="258">USA (2)</span>
                                                    <ul>
                                                        <li class="">
                                                            <div class="pretty p-icon p-thick p-curve">
                                                                <input type="checkbox" name="location[]" value="259"
                                                                    id="259" />
                                                                <div class="state p-warning">
                                                                    <i class="icon fa fa-check"></i>
                                                                    <label></label>
                                                                </div>
                                                            </div>
                                                            <span for="259">California (1)</span>
                                                            <ul></ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-btn">

                                    <p><i>Select the options and press the Filter Result button to apply the changes
                                        </i></p>
                                    <input type="hidden" name="sort" value="">
                                    <button class="btn btn-theme btn-block" type="submit"> Filter Result</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-xs-12 col-sm-12 col-md-12 col-lg-8">
                    <div class="row">
                        <div class="col-xl-12 col-xs-12 col-sm-12 col-md-12">
                            <div class="services-filter-2">
                                <form>
                                    <div class="heading-area">
                                        <h4>Found 9 Results </h4>
                                    </div>
                                    <div class="filters">
                                        <select class="default-select" name="sort" id="order_by">
                                            <option value="">Sort by</option>
                                            <option value="new-old"> Date: New to old</option>
                                            <option value="old-new"> Date: Old to new</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xs-12 col-sm-12 col-md-12">
                            <div class="adverts">
                                <a href="https://marketplace.exertiowp.com/"><img
                                        src="https://marketplace.exertiowp.com/wp-content/uploads/2021/01/00728x90.jpg"
                                        alt="exertio theme" class="img-fluid"></a>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xs-12 col-lg-12 col-sm-12 col-md-12">
                            <div class="fr-right-detail-box">
                                <div class="fr-right-detail-content">
                                    <div class="fr-right-details-products">
                                        <div class="features-star"><i class="fa fa-star"></i></div>
                                        <div class="fr-right-views">
                                            <ul>
                                                <li><span><a href="https://marketplace.exertiowp.com/employer/dean/"><i
                                                                class="fa fa-check"></i>VeeGaming Studio</a></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="fr-jobs-price">
                                            <div class="style-hd">
                                                $40.00<small class="protip" data-pt-position="top"
                                                    data-pt-scheme="black"
                                                    data-pt-title="Estimated Hours 100&lt;br&gt;&lt;br&gt;Total: 40*100= $4,000.00"><i
                                                        class="far fa-question-circle"></i></small> </div>
                                            <p>(hourly)</p>
                                        </div>
                                        <div class="fr-right-details2">
                                            <a
                                                href="https://marketplace.exertiowp.com/projects/ios-and-android-senior-mobile-app-developer/">
                                                <h3 title="iOS and Android SENIOR mobile app developer">iOS and Android
                                                    SENIOR mobile app developer</h3>
                                            </a>
                                        </div>
                                        <div class="fr-right-product">
                                            <ul class="skills">
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=105">Backend
                                                        Developer</a></li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=95">Designer</a>
                                                </li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=114">IOS
                                                        Developer</a></li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=99">Support
                                                        Agent</a></li>
                                            </ul>
                                        </div>
                                        <div class="fr-right-index">
                                            <p>( NO agency, please)) We are a computerized wellbeing startup with a spry
                                                and high-speed climate. We are searching for a Senior, RELIABLE portable
                                                application&hellip;</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="fr-right-information">
                                    <div class="fr-right-list">
                                        <ul>
                                            <li>
                                                <p class="heading"> Expiry: </p>
                                                <div>
                                                    <p>959 Days left</p>
                                                </div>
                                            </li>
                                            <li>
                                                <p class="heading">Proposals</p>
                                                <span>1 Received </span>
                                            </li>
                                            <li>
                                                <p class="heading">Location</p>
                                                <span>
                                                    Hamburg </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fr-right-bid">
                                        <ul>
                                            <li> <a href="javascript:void(0);" class="mark_fav protip "
                                                    data-post-id="2669" data-pt-position="top" data-pt-scheme="black"
                                                    data-pt-title="Save project"><i class="fa fa-heart active"></i></a>
                                            </li>
                                            <li><a href="https://marketplace.exertiowp.com/projects/ios-and-android-senior-mobile-app-developer/"
                                                    class="btn btn-theme"> Send Proposal </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xs-12 col-lg-12 col-sm-12 col-md-12">
                            <div class="fr-right-detail-box">
                                <div class="fr-right-detail-content">
                                    <div class="fr-right-details-products">
                                        <div class="features-star"><i class="fa fa-star"></i></div>
                                        <div class="fr-right-views">
                                            <ul>
                                                <li><span><a href="https://marketplace.exertiowp.com/employer/dean/"><i
                                                                class="fa fa-check"></i>VeeGaming Studio</a></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="fr-jobs-price">
                                            <div class="style-hd">
                                                $580.00 </div>
                                            <p>(fixed)</p>
                                        </div>
                                        <div class="fr-right-details2">
                                            <a
                                                href="https://marketplace.exertiowp.com/projects/integrate-insurance-marketplace-quotation-form-api-to-an-affiliate/">
                                                <h3
                                                    title="Integrate insurance marketplace quotation form API to an affiliate">
                                                    Integrate insurance marketplace quotation for....</h3>
                                            </a>
                                        </div>
                                        <div class="fr-right-product">
                                            <ul class="skills">
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=113">Android
                                                        Developer</a></li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=105">Backend
                                                        Developer</a></li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=95">Designer</a>
                                                </li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=94">Developer</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="fr-right-index">
                                            <p>This is a Great&nbsp; Moment for us to announce a designer job for our
                                                company, The candidate who falls in the criteria can apply.
                                                We&#8217;ll&hellip;</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="fr-right-information">
                                    <div class="fr-right-list">
                                        <ul>
                                            <li>
                                                <p class="heading"> Expiry: </p>
                                                <div>
                                                    <p>1690 Days left</p>
                                                </div>
                                            </li>
                                            <li>
                                                <p class="heading">Proposals</p>
                                                <span>1 Received </span>
                                            </li>
                                            <li>
                                                <p class="heading">Location</p>
                                                <span>
                                                    Remote </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fr-right-bid">
                                        <ul>
                                            <li> <a href="javascript:void(0);" class="mark_fav protip "
                                                    data-post-id="2662" data-pt-position="top" data-pt-scheme="black"
                                                    data-pt-title="Save project"><i class="fa fa-heart active"></i></a>
                                            </li>
                                            <li><a href="https://marketplace.exertiowp.com/projects/integrate-insurance-marketplace-quotation-form-api-to-an-affiliate/"
                                                    class="btn btn-theme"> Send Proposal </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xs-12 col-lg-12 col-sm-12 col-md-12">
                            <div class="fr-right-detail-box">
                                <div class="fr-right-detail-content">
                                    <div class="fr-right-details-products">
                                        <div class="fr-right-views">
                                            <ul>
                                                <li><span><a href="https://marketplace.exertiowp.com/employer/dean/"><i
                                                                class="fa fa-check"></i>VeeGaming Studio</a></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="fr-jobs-price">
                                            <div class="style-hd">
                                                $500.00 </div>
                                            <p>(fixed)</p>
                                        </div>
                                        <div class="fr-right-details2">
                                            <a
                                                href="https://marketplace.exertiowp.com/projects/need-technical-email-expert-emails-ending-up-in-spam-folder/">
                                                <h3
                                                    title="Need Technical Email Expert, Emails Ending Up in Spam Folder">
                                                    Need Technical Email Expert, Emails Ending Up....</h3>
                                            </a>
                                        </div>
                                        <div class="fr-right-product">
                                            <ul class="skills">
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=103">Artist</a>
                                                </li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=248">Data
                                                        Entry</a></li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=95">Designer</a>
                                                </li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=249">Logo
                                                        Design</a></li>
                                                <li class="hide"><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=98">QA
                                                        Speciallist</a></li>
                                                <li class="show-skills"><a href="javascript:void(0)"><i
                                                            class="fas fa-ellipsis-h"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="fr-right-index">
                                            <p>We are a land business based out of LA and we are experiencing difficulty
                                                with our messages winding up in spam envelopes. We have used&hellip;</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="fr-right-information">
                                    <div class="fr-right-list">
                                        <ul>
                                            <li>
                                                <p class="heading"> Expiry: </p>
                                                <div>
                                                    <p>Never Expire </p>
                                                </div>
                                            </li>
                                            <li>
                                                <p class="heading">Proposals</p>
                                                <span>1 Received </span>
                                            </li>
                                            <li>
                                                <p class="heading">Location</p>
                                                <span>
                                                    Remote </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fr-right-bid">
                                        <ul>
                                            <li> <a href="javascript:void(0);" class="mark_fav protip "
                                                    data-post-id="2670" data-pt-position="top" data-pt-scheme="black"
                                                    data-pt-title="Save project"><i class="fa fa-heart active"></i></a>
                                            </li>
                                            <li><a href="https://marketplace.exertiowp.com/projects/need-technical-email-expert-emails-ending-up-in-spam-folder/"
                                                    class="btn btn-theme"> Send Proposal </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xs-12 col-lg-12 col-sm-12 col-md-12">
                            <div class="fr-right-detail-box">
                                <div class="fr-right-detail-content">
                                    <div class="fr-right-details-products">
                                        <div class="fr-right-views">
                                            <ul>
                                                <li><span><a
                                                            href="https://marketplace.exertiowp.com/employer/scriptsbundle60/"><i
                                                                class="fa fa-check verified protip"
                                                                data-pt-position="top" data-pt-scheme="black"
                                                                data-pt-title=" Verified"></i> HRM Recruitment
                                                            Center</a></span> </li>
                                            </ul>
                                        </div>
                                        <div class="fr-jobs-price">
                                            <div class="style-hd">
                                                $20.00<small class="protip" data-pt-position="top"
                                                    data-pt-scheme="black"
                                                    data-pt-title="Estimated Hours 80&lt;br&gt;&lt;br&gt;Total: 20*80= $1,600.00"><i
                                                        class="far fa-question-circle"></i></small> </div>
                                            <p>(hourly)</p>
                                        </div>
                                        <div class="fr-right-details2">
                                            <a
                                                href="https://marketplace.exertiowp.com/projects/website-designer-required-for-directory-theme-2/">
                                                <h3 title="Website Designer required for directory theme">Website
                                                    Designer required for directory theme</h3>
                                            </a>
                                        </div>
                                        <div class="fr-right-product">
                                            <ul class="skills">
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=103">Artist</a>
                                                </li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=95">Designer</a>
                                                </li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=94">Developer</a>
                                                </li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=114">IOS
                                                        Developer</a></li>
                                                <li class="hide"><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=99">Support
                                                        Agent</a></li>
                                                <li class="show-skills"><a href="javascript:void(0)"><i
                                                            class="fas fa-ellipsis-h"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="fr-right-index">
                                            <p>This is a Great&nbsp; Moment for us to announce a designer job for our
                                                company, The candidate who falls in the criteria can apply.
                                                We&#8217;ll&hellip;</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="fr-right-information">
                                    <div class="fr-right-list">
                                        <ul>
                                            <li>
                                                <p class="heading"> Expiry: </p>
                                                <div>
                                                    <p>917 Days left</p>
                                                </div>
                                            </li>
                                            <li>
                                                <p class="heading">Proposals</p>
                                                <span>3 Received </span>
                                            </li>
                                            <li>
                                                <p class="heading">Location</p>
                                                <span>
                                                    Remote </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fr-right-bid">
                                        <ul>
                                            <li> <a href="javascript:void(0);" class="mark_fav protip "
                                                    data-post-id="806" data-pt-position="top" data-pt-scheme="black"
                                                    data-pt-title="Save project"><i class="fa fa-heart active"></i></a>
                                            </li>
                                            <li><a href="https://marketplace.exertiowp.com/projects/website-designer-required-for-directory-theme-2/"
                                                    class="btn btn-theme"> Send Proposal </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xs-12 col-lg-12 col-sm-12 col-md-12">
                            <div class="fr-right-detail-box">
                                <div class="fr-right-detail-content">
                                    <div class="fr-right-details-products">
                                        <div class="fr-right-views">
                                            <ul>
                                                <li><span><a href="https://marketplace.exertiowp.com/employer/jason/"><i
                                                                class="fa fa-check verified protip"
                                                                data-pt-position="top" data-pt-scheme="black"
                                                                data-pt-title=" Verified"></i> Nethin Corporation
                                                            Ltd.</a></span> </li>
                                            </ul>
                                        </div>
                                        <div class="fr-jobs-price">
                                            <div class="style-hd">
                                                $800.00 </div>
                                            <p>(fixed)</p>
                                        </div>
                                        <div class="fr-right-details2">
                                            <a
                                                href="https://marketplace.exertiowp.com/projects/react-native-developer-is-required-for-our-organization/">
                                                <h3 title="React Native developer is required for our office">React
                                                    Native developer is required for our of....</h3>
                                            </a>
                                        </div>
                                        <div class="fr-right-product">
                                            <ul class="skills">
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=113">Android
                                                        Developer</a></li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=94">Developer</a>
                                                </li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=114">IOS
                                                        Developer</a></li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=98">QA
                                                        Speciallist</a></li>
                                            </ul>
                                        </div>
                                        <div class="fr-right-index">
                                            <p>Tech Software is looking for a Mobile Developer who has a solid creation
                                                foundation to React Native to go along with us in creating
                                                premium&hellip;</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="fr-right-information">
                                    <div class="fr-right-list">
                                        <ul>
                                            <li>
                                                <p class="heading"> Expiry: </p>
                                                <div>
                                                    <p>907 Days left</p>
                                                </div>
                                            </li>
                                            <li>
                                                <p class="heading">Proposals</p>
                                                <span>2 Received </span>
                                            </li>
                                            <li>
                                                <p class="heading">Location</p>
                                                <span>
                                                    Victoria </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fr-right-bid">
                                        <ul>
                                            <li> <a href="javascript:void(0);" class="mark_fav protip "
                                                    data-post-id="225" data-pt-position="top" data-pt-scheme="black"
                                                    data-pt-title="Save project"><i class="fa fa-heart active"></i></a>
                                            </li>
                                            <li><a href="https://marketplace.exertiowp.com/projects/react-native-developer-is-required-for-our-organization/"
                                                    class="btn btn-theme"> Send Proposal </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xs-12 col-lg-12 col-sm-12 col-md-12">
                            <div class="fr-right-detail-box">
                                <div class="fr-right-detail-content">
                                    <div class="fr-right-details-products">
                                        <div class="fr-right-views">
                                            <ul>
                                                <li><span><a href="https://marketplace.exertiowp.com/employer/finn/"><i
                                                                class="fa fa-check"></i>The Gentelmans Org.</a></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="fr-jobs-price">
                                            <div class="style-hd">
                                                $450.00 </div>
                                            <p>(fixed)</p>
                                        </div>
                                        <div class="fr-right-details2">
                                            <a
                                                href="https://marketplace.exertiowp.com/projects/blog-writer-for-a-website/">
                                                <h3 title="Need a blog writer for a long term job">Need a blog writer
                                                    for a long term job</h3>
                                            </a>
                                        </div>
                                        <div class="fr-right-product">
                                            <ul class="skills">
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=103">Artist</a>
                                                </li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=248">Data
                                                        Entry</a></li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=95">Designer</a>
                                                </li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=94">Developer</a>
                                                </li>
                                                <li class="hide"><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=100">Writter</a>
                                                </li>
                                                <li class="show-skills"><a href="javascript:void(0)"><i
                                                            class="fas fa-ellipsis-h"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="fr-right-index">
                                            <p>we need an essayist that can compose 10 interesting weight reduction
                                                articles, around 1000 words each. Authors need to comprehend the
                                                item/supplement prior to composing&hellip;</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="fr-right-information">
                                    <div class="fr-right-list">
                                        <ul>
                                            <li>
                                                <p class="heading"> Expiry: </p>
                                                <div>
                                                    <p>907 Days left</p>
                                                </div>
                                            </li>
                                            <li>
                                                <p class="heading">Proposals</p>
                                                <span>2 Received </span>
                                            </li>
                                            <li>
                                                <p class="heading">Location</p>
                                                <span>
                                                    Remote </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fr-right-bid">
                                        <ul>
                                            <li> <a href="javascript:void(0);" class="mark_fav protip "
                                                    data-post-id="224" data-pt-position="top" data-pt-scheme="black"
                                                    data-pt-title="Save project"><i class="fa fa-heart active"></i></a>
                                            </li>
                                            <li><a href="https://marketplace.exertiowp.com/projects/blog-writer-for-a-website/"
                                                    class="btn btn-theme"> Send Proposal </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xs-12 col-lg-12 col-sm-12 col-md-12">
                            <div class="fr-right-detail-box">
                                <div class="fr-right-detail-content">
                                    <div class="fr-right-details-products">
                                        <div class="fr-right-views">
                                            <ul>
                                                <li><span><a href="https://marketplace.exertiowp.com/employer/dean/"><i
                                                                class="fa fa-check"></i>VeeGaming Studio</a></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="fr-jobs-price">
                                            <div class="style-hd">
                                                $800.00 </div>
                                            <p>(fixed)</p>
                                        </div>
                                        <div class="fr-right-details2">
                                            <a
                                                href="https://marketplace.exertiowp.com/projects/website-designer-required-for-directory-theme/">
                                                <h3 title="Website Designer required for directory theme">Website
                                                    Designer required for directory theme</h3>
                                            </a>
                                        </div>
                                        <div class="fr-right-product">
                                            <ul class="skills">
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=105">Backend
                                                        Developer</a></li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=95">Designer</a>
                                                </li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=98">QA
                                                        Speciallist</a></li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=100">Writter</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="fr-right-index">
                                            <p>We need an eye-catching design for our website. The design should be the
                                                latest technologies e.g sass, js, and boot stripe 5. The design
                                                should&hellip;</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="fr-right-information">
                                    <div class="fr-right-list">
                                        <ul>
                                            <li>
                                                <p class="heading"> Expiry: </p>
                                                <div>
                                                    <p>907 Days left</p>
                                                </div>
                                            </li>
                                            <li>
                                                <p class="heading">Proposals</p>
                                                <span>3 Received </span>
                                            </li>
                                            <li>
                                                <p class="heading">Location</p>
                                                <span>
                                                    Remote </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fr-right-bid">
                                        <ul>
                                            <li> <a href="javascript:void(0);" class="mark_fav protip "
                                                    data-post-id="223" data-pt-position="top" data-pt-scheme="black"
                                                    data-pt-title="Save project"><i class="fa fa-heart active"></i></a>
                                            </li>
                                            <li><a href="https://marketplace.exertiowp.com/projects/website-designer-required-for-directory-theme/"
                                                    class="btn btn-theme"> Send Proposal </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xs-12 col-lg-12 col-sm-12 col-md-12">
                            <div class="fr-right-detail-box">
                                <div class="fr-right-detail-content">
                                    <div class="fr-right-details-products">
                                        <div class="fr-right-views">
                                            <ul>
                                                <li><span><a href="https://marketplace.exertiowp.com/employer/paul/"><i
                                                                class="fa fa-check"></i>The Paul Datahost
                                                            Org.</a></span> </li>
                                            </ul>
                                        </div>
                                        <div class="fr-jobs-price">
                                            <div class="style-hd">
                                                $800.00 </div>
                                            <p>(fixed)</p>
                                        </div>
                                        <div class="fr-right-details2">
                                            <a
                                                href="https://marketplace.exertiowp.com/projects/looking-for-content-writer-for-my-website/">
                                                <h3 title="Looking for a content writer for my website.">Looking for a
                                                    content writer for my website.</h3>
                                            </a>
                                        </div>
                                        <div class="fr-right-product">
                                            <ul class="skills">
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=248">Data
                                                        Entry</a></li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=98">QA
                                                        Speciallist</a></li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=99">Support
                                                        Agent</a></li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=100">Writter</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="fr-right-index">
                                            <p>We are searching for a quality substance essayist who can take up an
                                                undertaking that is dire. I earnestly need experienced authors who can
                                                think&hellip;</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="fr-right-information">
                                    <div class="fr-right-list">
                                        <ul>
                                            <li>
                                                <p class="heading"> Expiry: </p>
                                                <div>
                                                    <p>Never Expire </p>
                                                </div>
                                            </li>
                                            <li>
                                                <p class="heading">Proposals</p>
                                                <span>3 Received </span>
                                            </li>
                                            <li>
                                                <p class="heading">Location</p>
                                                <span>
                                                    Victoria </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fr-right-bid">
                                        <ul>
                                            <li> <a href="javascript:void(0);" class="mark_fav protip "
                                                    data-post-id="222" data-pt-position="top" data-pt-scheme="black"
                                                    data-pt-title="Save project"><i class="fa fa-heart active"></i></a>
                                            </li>
                                            <li><a href="https://marketplace.exertiowp.com/projects/looking-for-content-writer-for-my-website/"
                                                    class="btn btn-theme"> Send Proposal </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xs-12 col-lg-12 col-sm-12 col-md-12">
                            <div class="fr-right-detail-box">
                                <div class="fr-right-detail-content">
                                    <div class="fr-right-details-products">
                                        <div class="fr-right-views">
                                            <ul>
                                                <li><span><a href="https://marketplace.exertiowp.com/employer/edison/"><i
                                                                class="fa fa-check"></i>Gamers Move</a></span> </li>
                                            </ul>
                                        </div>
                                        <div class="fr-jobs-price">
                                            <div class="style-hd">
                                                $20.00<small class="protip" data-pt-position="top"
                                                    data-pt-scheme="black"
                                                    data-pt-title="Estimated Hours 100&lt;br&gt;&lt;br&gt;Total: 20*100= $2,000.00"><i
                                                        class="far fa-question-circle"></i></small> </div>
                                            <p>(hourly)</p>
                                        </div>
                                        <div class="fr-right-details2">
                                            <a
                                                href="https://marketplace.exertiowp.com/projects/assemble-a-3d-activity-of-35-seconds/">
                                                <h3 title="Assemble a 3D activity of 35 seconds">Assemble a 3D activity
                                                    of 35 seconds</h3>
                                            </a>
                                        </div>
                                        <div class="fr-right-product">
                                            <ul class="skills">
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=103">Artist</a>
                                                </li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=95">Designer</a>
                                                </li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=94">Developer</a>
                                                </li>
                                                <li class=""><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=102">Musician</a>
                                                </li>
                                                <li class="hide"><a
                                                        href="https://marketplace.exertiowp.com/project-search/?skill=101">Singer</a>
                                                </li>
                                                <li class="show-skills"><a href="javascript:void(0)"><i
                                                            class="fas fa-ellipsis-h"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="fr-right-index">
                                            <p>Fabricate a 3D liveliness of 35 seconds I need somebody who can make a
                                                site like a study bhandar. New people can likewise get this&hellip;</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="fr-right-information">
                                    <div class="fr-right-list">
                                        <ul>
                                            <li>
                                                <p class="heading"> Expiry: </p>
                                                <div>
                                                    <p>Never Expire </p>
                                                </div>
                                            </li>
                                            <li>
                                                <p class="heading">Proposals</p>
                                                <span>3 Received </span>
                                            </li>
                                            <li>
                                                <p class="heading">Location</p>
                                                <span>
                                                    Victoria </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fr-right-bid">
                                        <ul>
                                            <li> <a href="javascript:void(0);" class="mark_fav protip "
                                                    data-post-id="221" data-pt-position="top" data-pt-scheme="black"
                                                    data-pt-title="Save project"><i class="fa fa-heart active"></i></a>
                                            </li>
                                            <li><a href="https://marketplace.exertiowp.com/projects/assemble-a-3d-activity-of-35-seconds/"
                                                    class="btn btn-theme"> Send Proposal </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xs-12 col-sm-12 col-md-12">
                            <div class="adverts">
                                <a href="https://marketplace.exertiowp.com/"><img
                                        src="https://marketplace.exertiowp.com/wp-content/uploads/2021/01/728x90.jpg"
                                        alt="exertio theme" class="img-fluid"></a>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xs-12 col-sm-12 col-md-12"></div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <section class="fr-bg-style2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-xs-12 col-sm-12 col-md-12">
                    <div class="fr-bg-style">
                        <div class="row">
                            <div class="col-xl-8 col-lg-8">
                                <div class="fr-gt-content">
                                    <h3>Ready To Get Started</h3>
                                    <p>The Exertio is a Premium WordPress Theme, you can create your own market place
                                        website using this theme. It allows you to get a commission for hiring a
                                        freelancer or for each service sold.</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 align-self-center">
                                <div class="fr-gt-btn"> <a href="https://marketplace.exertiowp.com/login/"
                                        class="btn btn-theme">Get Started</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection