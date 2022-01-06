# 基于PHP写的OCR图片识别
<br>将图片上的文字以json,txt,包含位置的json返回</br>
# 接口参数
<br>请求:ocr.php</br>
<br>请求类型:post</br>
<br>请求参数：</br>
<br>str：可以链接图片，可以base64编码图片(完整)</br>
<br>format：可选参数，默认json_txt，可选：json,txt。</br>
# 请求示例
<br>https://ss0.bdstatic.com/70cFuHSh_Q1YnxGkpoWK1HF6hhy/it/u=4089793816,637672192&fm=27&gp=0.jpg</br>
<br>json:</br>
<br>{"code":200,"msg":[{"probability":{"average":0.889431,"min":0.722928,"variance":0.012804},"words":"经典名句"},{"probability":{"average":0.98609,"min":0.876068,"variance":0.001307},"words":"关关雎鸠,在河之洲,窃窕淑女,君子好逑。"},{"probability":{"average":0.931837,"min":0.485365,"variance":0.021121},"words":"—《诗经·周南·关雎》"},{"probability":{"average":0.961141,"min":0.560213,"variance":0.011692},"words":"译:雎鸠相对唱叫着,双栖河里小岛上。文静美丽"},{"probability":{"average":0.997011,"min":0.980833,"variance":3.2e-5},"words":"的好姑娘,让我时刻放心上。"}]}</br>
<br>json_txt:</br>
<br>{"code":200,"msg":"经典名句关关雎鸠,在河之洲,窃窕淑女,君子好逑。—《诗经·周南·关雎》译:雎鸠相对唱叫着,双栖河里小岛上。文静美丽的好姑娘,让我时刻放心上。"}</br>
<br>txt:</br>
<br>经典名句关关雎鸠,在河之洲,窃窕淑女,君子好逑。—《诗经·周南·关雎》译:雎鸠相对唱叫着,双栖河里小岛上。文静美丽的好姑娘,让我时刻放心上。</br>
