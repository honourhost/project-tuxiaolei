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
                                    <label class="col-sm-1">上传营业执照</label>
										<span class="col-sm-2" style="padding-left:0px;">
                                             <if condition="$flag">
                                                 <input id="ytimage-file" type="hidden" value="" name="business_liscence_image"/>
                                                 <input class="col-sm-1" id="business_liscence_image-file" size="200" onchange="preview_business_liscence_image(this)" name="business_liscence_image" type="file"/>
                                             </if>
											<span class="form_tips">上传营业执照请保持字体清晰 大小不超过1M，请参考右侧示例</span>
										</span>
                                </div>
                                <div style="width: 100%; clear: both;"></div>
                                <div class="form-group">
                                    <label class="col-sm-1">执照预览</label>
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
                                    <label class="col-sm-1">身份证正反面</label>
                                    <div class="sc-zhao-left">
                                        <if condition="$flag">
                                            <input id="ytimage-file" type="hidden" value="" name="legal_represent_cardimage"/>
                                            <input class="col-sm-1" id="legal_represent_cardimage-file" size="200" onchange="preview_legal_represent_cardimage(this)" name="legal_represent_cardimage" type="file"/>
                                        </if>
                                        <span class="form_tips">身份证照片为正反两面扫描件，须字体清晰，合并到一张图片上传即可，如右图所示</span>
                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                                <div class="form-group">
                                    <label class="col-sm-1">身份证预览</label>
                                    <div id="legal_represent_cardimage_box">
                                        <if condition="$company['legal_represent_cardimage']">
                                            <img style="width:400px;height:600px" src="{pigcms{$company.legal_represent_cardimage}" alt="图片预览" title="图片预览"/>
                                        </if>
                                    </div>
                                </div>
                                <div class="form-group sc-zhao">
                                    <label class="col-sm-1">手持身份证照</label>
                                    <div class="sc-zhao-left">
                                        <if condition="$flag">
                                            <input id="ytimage-file" type="hidden" value="" name="company_handcardimage"/>
                                            <input class="col-sm-1" id="company_handcardimage-file" size="200" onchange="preview_company_handcardimage(this)" name="company_handcardimage" type="file"/>
                                        </if>
                                        <span class="form_tips">个人手持身份证拍照，如右图所示需要五官清楚，身份证上面的文字清楚</span>
                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                                <div class="form-group">
                                    <label class="col-sm-1">手持身份证预览</label>
                                    <div id="hand_cardimage_box">
                                        <if condition="$company['company_handcardimage']">
                                            <img style="width:600px;height:400px" src="{pigcms{$company.company_handcardimage}" alt="图片预览" title="图片预览"/>
                                        </if>
                                    </div>
                                </div>
                                 <div class="form-group">
                                            <label class="col-sm-1">
                                                <label>最后一次的反馈信息</label></br>
                                            </label>
                                            <textarea class="col-sm-5" rows="5" name="response_info" >{pigcms{$company.response_info}</textarea>
                                 </div>
<include file="Public:footer"/>