<include file="Public:header"/>
<div class="mainbox">
    <div class="form-group">
        <label class="col-sm-1">
            <label>农场主名称</label>
        </label>
        <if condition="$flag">
            <input class="col-sm-2" size="20" value="{pigcms{$person.person_name}" type="text" name="person_name" />
            <else/>
            <span class="col-sm-2">{pigcms{$person.person_name}</span>
        </if>
    </div>
    <div style="width: 100%; clear: both;"></div>
    <div class="form-group">
        <label class="col-sm-1">
            <label>身份证号</label>
        </label>
        <if condition="$flag">
            <input class="col-sm-2" size="20" value="{pigcms{$person.person_cardno}" type="text" name="person_cardno" />
            <else/>
            <span class="col-sm-2">{pigcms{$person.person_cardno}</span>
        </if>
    </div>
    <div style="width: 100%; clear: both;"></div>
    <div class="form-group sc-zhao">
        <label class="col-sm-1">身份证正反面</label>
        <div class="sc-zhao-left">
            <if condition="$flag">
                <input id="ytimage-file" type="hidden" value="" name="person_cardimage"/>
                <input class="col-sm-1" id="person_cardimage-file" size="200" onchange="preview_person_cardimage(this)" name="person_cardimage" type="file"/>
            </if>
            <span class="form_tips">身份证照片为正反两面扫描件，须字体清晰，合并到一张图片上传即可，如右图所示</span>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div class="form-group">
        <label class="col-sm-1">身份证预览</label>
        <div id="person_cardimage_box">
            <if condition="$person['person_cardimage']">
                <img style="width:400px;height:600px" src="{pigcms{$person.person_cardimage}" alt="图片预览" title="图片预览"/>
            </if>
        </div>
    </div>
    <div class="form-group sc-zhao">
        <label class="col-sm-1">手持身份证照</label>
        <div class="sc-zhao-left">
            <if condition="$flag">
                <input id="ytimage-file" type="hidden" value="" name="person_handcardimage"/>
                <input class="col-sm-1" id="person_handcardimage-file" size="200" onchange="preview_person_handcardimage(this)" name="person_handcardimage" type="file"/>
            </if>
            <span class="form_tips">个人手持身份证拍照，如右图所示需要五官清楚，身份证上面的文字清楚</span>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div class="form-group">
        <label class="col-sm-1">手持证件照预览</label>
        <div id="person_handcardimage_box">
            <if condition="$person['person_handcardimage']">
                <img style="width:600px;height:400px" src="{pigcms{$person.person_handcardimage}" alt="图片预览" title="图片预览"/>
            </if>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-1">个人农场简介</label>
        <if condition="$flag">
            <textarea class="col-sm-5" rows="5" name="person_farm_info">{pigcms{$person.person_farm_info}</textarea>
            <else/>
            <span>{pigcms{$person.person_farm_info}</span>
        </if>
    </div>
    <form method="post">
        <div class="form-group">
            <input name="id" value="{pigcms{$person.id}" type="hidden">
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
            <textarea class="col-sm-5" rows="5" name="response_info" >{pigcms{$person.response_info}</textarea>
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