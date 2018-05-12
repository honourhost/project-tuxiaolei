<include file="Public:header"/>
<div class="mainbox">
                                <div class="form-group">
                                    <label class="col-sm-1">
                                        <label>公司名称</label>
                                    </label>
                                    <if condition="$flag">
                                        <input class="col-sm-2" size="20" type="text" name="company_name" value="{pigcms{$company.company_name}"/>
                                        <else/>
                                        <span>{pigcms{$company.company_name}</span>
                                    </if>
                                </div>
                                <div style="width: 100%; clear: both;"></div>
                                <div class="form-group">
                                    <label class="col-sm-1">公司简介</label>
                                    <if condition="$flag">
                                        <textarea class="col-sm-5" rows="5" name="company_info" >{pigcms{$company.company_info}</textarea>
                                        <else/>
                                        <span>{pigcms{$company.company_info}</span>
                                    </if>
                                </div>
                                <div style="width: 100%; clear: both;"></div>
                                <div class="form-group">
                                    <label class="col-sm-1">
                                        <label>营业执照号</label>
                                    </label>
                                    <if condition="$flag">
                                        <input class="col-sm-2" size="20" value="{pigcms{$company.business_liscence_no}" type="text" name="business_liscence_no" />
                                        <else/>
                                        <span>{pigcms{$company.business_liscence_no}</span>
                                    </if>
                                </div>
                                <div style="width: 100%; clear: both;"></div>
                                <div class="form-group">
                                    <label class="col-sm-1">营业执照</label>
										<span class="col-sm-2" style="padding-left:0px;">
                                             <if condition="$flag">
                                                 <input id="ytimage-file" type="hidden" value="" name="business_liscence_image"/>
                                                 <input class="col-sm-1" id="business_liscence_image-file" size="200" onchange="preview_business_liscence_image(this)" name="business_liscence_image" type="file"/>
                                             </if>
										</span>
                                </div>
                                <div style="width: 100%; clear: both;"></div>
                                <div class="form-group">
                                    <label class="col-sm-1">预览</label>
                                    <div id="business_liscence_image_preview_box">
                                        <if condition="$company['business_liscence_image']">
                                            <img style="width:600px;height:400px" src="{pigcms{$company.business_liscence_image}" alt="图片预览" title="图片预览"/>
                                        </if>
                                    </div>
                                </div>
                                <div style="width: 100%; clear: both;"></div>
                                <div class="form-group">
                                    <label class="col-sm-1">
                                        <label>法人代表</label>
                                    </label>
                                    <if condition="$flag">
                                        <input class="col-sm-2" size="20" value="{pigcms{$company.legal_represent}" type="text" name="legal_represent" />
                                        <else/>
                                        <span>{pigcms{$company.legal_represent}</span>
                                    </if>
                                    <span class="form_tips">必须与公司营业执照一致</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">
                                        <label>法人身份证</label>
                                    </label>
                                    <if condition="$flag">
                                        <input class="col-sm-2" size="20" type="text" name="legal_represent_cardno" value="{pigcms{$company.legal_represent_cardno}"/>
                                        <else/>
                                        <span>{pigcms{$company.legal_represent_cardno}</span>
                                    </if>
                                </div>
                                <div style="width: 100%; clear: both;"></div>
                                <div class="form-group sc-zhao">
                                    <label class="col-sm-1">身份证正面</label>
                                    <div class="sc-zhao-left">
                                        <if condition="$flag">
                                            <input id="ytimage-file" type="hidden" value="" name="legal_represent_cardimage"/>
                                            <input class="col-sm-1" id="legal_represent_cardimage-file" size="200" onchange="preview_legal_represent_cardimage(this)" name="legal_represent_cardimage" type="file"/>
                                        </if>
                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                                <div class="form-group">
                                    <label class="col-sm-1">预览</label>
                                    <div id="legal_represent_cardimage_box">
                                        <if condition="$company['legal_represent_cardimage']">
                                            <img style="width:600px;height:400px" src="{pigcms{$company.legal_represent_cardimage}" alt="图片预览" title="图片预览"/>
                                        </if>
                                    </div>
                                </div>
                                <div class="form-group sc-zhao">
                                    <label class="col-sm-1">身份证反面</label>
                                    <div class="sc-zhao-left">
                                        <if condition="$flag">
                                            <input id="ytimage-file" type="hidden" value="" name="legal_represent_cardimage_other"/>
                                            <input class="col-sm-1" id="legal_represent_cardimage_other-file" size="200" onchange="preview_legal_represent_cardimage_other(this)" name="legal_represent_cardimage_other" type="file"/>
                                        </if>
                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                                <div class="form-group">
                                    <label class="col-sm-1">预览</label>
                                    <div id="legal_represent_cardimage_other_box">
                                        <if condition="$company['legal_represent_cardimage_other']">
                                            <img style="width:600px;height:400px" src="{pigcms{$company.legal_represent_cardimage_other}" alt="图片预览" title="图片预览"/>
                                        </if>
                                    </div>
                                </div>
                                    <form method="post">
                                    <div class="form-group">
                                        <input name="id" value="{pigcms{$company.id}" type="hidden">
                                        <select name="status">
                                            <option value="0" selected>不处理</option>
                                            <option value="1">通过</option>
                                            <option value="2">驳回</option>
                                        </select>
                                    </div>
                                        <div class="form-group">
                                            <label class="col-sm-1">
                                                <label>反馈信息（如果驳回申请请填写）</label></br>
                                            </label>
                                            <textarea class="col-sm-5" rows="5" name="response_info" >{pigcms{$company.response_info}</textarea>
                                        </div>

                                    <div class="clearfix form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button class="btn btn-info" type="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i> 提交申请
                                            </button>
                                        </div>
                                    </div>
                                    </form>
<include file="Public:footer"/>