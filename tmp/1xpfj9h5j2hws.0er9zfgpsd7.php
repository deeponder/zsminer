 <script type="text/javascript">

function $_js(id) 
{ 
  return document.getElementById(id); 
}

var crtPage=1;//当前页面
var stdInfo;//喜报信息
var pageSize=30;//页面大小
var totalPages=0;//页面总数
/*
*根据数据库中内容添加分页页码
*/
function addPageNumber(totalPageNum)
{
      clearPageIndex();
      var newLI=document.createElement('li');
      newLI.innerHTML="<span onclick=\"prePage();\">&laquo;</span>";
       $_js('pagination').appendChild(newLI);
       for (var i = 0; i <totalPageNum; i++) {
        var newLI=document.createElement('li');
         newLI.innerHTML="<span onclick=\"gotoPage("+(i+1)+");\">"+(i+1)+"</span>";
        $_js('pagination').appendChild(newLI);
        };
      var newLI=document.createElement('li');
      newLI.innerHTML="<span onclick=\"nextPage();\">&raquo;</span>";
       $_js('pagination').appendChild(newLI);
}

//清除页码
function clearPageIndex()
{
  while($_js('pagination').childNodes.length!=0)
   {
    $_js('pagination').removeChild($_js('pagination').childNodes[0]);
   }
  
}
//跳转页面函数
//$parm pageNum要跳转的页面数
function gotoPage(pageNum)
{
  if(crtPage==pageNum)
    alert("已经是当前页了");
  crtPage=pageNum;//设置当前访问页面
  clearXBTable();//先清空原来的表
  createXBTableHead();//创建喜报表表头
  createTableBody(pageNum);//创建喜报表内容
}

function prePage()
{
   if(crtPage==1)
    {
      alert("已经是第一页了");
    }
    else
    {
      gotoPage(crtPage-1);
    }
}

function nextPage()
{
   if(crtPage==totalPages)
    {
      alert("已经是最后一页了");
    }
    else
    {
      gotoPage(crtPage+1);
    }
}

//创建喜报表头
//喜报表id=showXB
function createXBTableHead()
{
  var newTHEAD=document.createElement('thead');
  var newTR=document.createElement('tr');
  var newTD1=document.createElement('th');
  newTD1.innerHTML="学生姓名";
  var newTD2=document.createElement('th');
  newTD2.innerHTML="竞赛/获奖";
  var newTD3=document.createElement('th');
  newTD3.innerHTML="竞赛/获奖等级";
  newTR.appendChild(newTD1);
  newTR.appendChild(newTD2);
  newTR.appendChild(newTD3);
  newTHEAD.appendChild(newTR);
  $_js('showXB').appendChild(newTHEAD);
}

function createTableBody(pageNum)
{
  var newTBODY=document.createElement('tbody');
  var showXBNum=Math.min(
      stdInfo.length-pageSize*(pageNum-1),pageSize);
  for (var i=pageSize*(pageNum-1);
          i<showXBNum+pageSize*(pageNum-1);i++)
  { 
      var newTR=document.createElement('tr');
      var newTD1=document.createElement('td');
      newTD1.innerHTML=stdInfo[i].getElementsByTagName("stdName")[0]
                      .childNodes[0].nodeValue;
      var newTD2=document.createElement('td');
      newTD2.innerHTML=stdInfo[i].getElementsByTagName("raceName")[0]
                      .childNodes[0].nodeValue;
      var newTD3=document.createElement('td');
    newTD3.innerHTML=stdInfo[i].getElementsByTagName("raceLevel")[0]
                      .childNodes[0].nodeValue;
      newTR.appendChild(newTD1);
      newTR.appendChild(newTD2);
      newTR.appendChild(newTD3);
      newTBODY.appendChild(newTR); 
  }  
  $_js('showXB').appendChild(newTBODY);
}

//清空喜报table
  function clearXBTable()
  {
    rowNum=$_js('showXB').rows.length;
    for (i=0;i< rowNum;i++)
    {
      $_js('showXB').deleteRow(i);
      rowNum=rowNum-1;
      i=i-1;
    }
  }

 //创建Ajax引擎对象
 function createXmlHttpRequestObject()
{
  var xmlHttpRequestObject = null;
        //不同的浏览器具有不同的创建方法    
        if (window.ActionXObject)
        {

            //创建IE浏览器Ajax对象
            xmlHttpRequestObject = new  ActionXObject("Microsoft.XMLHTTP");
        } else
        {
            //创建火狐浏览器Ajax对象
            xmlHttpRequestObject = new XMLHttpRequest();
        }
          return xmlHttpRequestObject;
}
var myXmlHttpRequest=null;

function proChange()
{ 
  myXmlHttpRequest=createXmlHttpRequestObject();
   if (myXmlHttpRequest) 
   {
     var data="province="+$_js('provinces').value;
     var url="./prosubmit";
     myXmlHttpRequest.open("post", url, true);
     myXmlHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
     myXmlHttpRequest.onreadystatechange=getSchools;
     myXmlHttpRequest.send(data);      
   }
}
//回调函数：接收从服务器发回的数据
function getSchools()
{
    //取回从服务器处理完的数据
    if (myXmlHttpRequest.readyState==4)
    {
      if (myXmlHttpRequest.status==200)
      { 
        var schools=myXmlHttpRequest.responseXML
        .getElementsByTagName("school");

        $_js('schools').length=0;
        var schoolOption=document.createElement("option");
        schoolOption.value="--选择高校--";
        schoolOption.innerText="--选择高校--";
        //在select中添加option
        $_js('schools').appendChild(schoolOption);
         for (var i = 0; i < schools.length; i++) 
         {
            var schoolName=schools[i].childNodes[0].nodeValue;
            //console.log(schoolName);
            //创建新的option
            var schoolOption=document.createElement("option");
            schoolOption.value=schoolName;
            schoolOption.innerText=schoolName;
            //在select中添加option
           $_js('schools').appendChild(schoolOption);
         }
    }
  }
}

function getXBContBySchool()
{
   myXmlHttpRequest=createXmlHttpRequestObject();
   if (myXmlHttpRequest) 
   {
     var data="school="+$_js('schools').value;
     var url="./schoolXBsubmit";
     myXmlHttpRequest.open("post", url, true);
     myXmlHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
     myXmlHttpRequest.onreadystatechange=getSchoolXBCon;
     myXmlHttpRequest.send(data);      
   }
}

function getSchoolXBCon()
{
  //取回从服务器处理完的数据
    if (myXmlHttpRequest.readyState==4)
    {
      if (myXmlHttpRequest.status==200)
      { 

        stdInfo=myXmlHttpRequest.responseXML
        .getElementsByTagName("studentInfo");
        totalPages=parseInt(stdInfo.length/pageSize)+1;//页面总数
        addPageNumber(totalPages);
        crtPage=1;//刚创建table 所有访问的是第一页
        //喜报表表头提示
        $_js('briefXB').innerHTML="共<b>"+stdInfo.length+"</b>条喜报";
        clearXBTable();//先清空原来的表
        createXBTableHead();//创建喜报表头
        createTableBody(1);//创建喜报表内容
      }
    }
}

</script>
 <div class="filter-cond">
            <span>查询条件</span>
            <div class="form-inline report" action="">
           <div class="form-group">
                <label for="inputProvince">省份</label>
                <select class="form-control" id="provinces" 
                                       onchange="proChange();">
                  <option value ="null">--选择省份--
                   </option>
                 <?php foreach (($proInfo?:array()) as $proInfo): ?> 
                   <option value ="<?php echo trim($proInfo['name']); ?>">
                       <?php echo trim($proInfo['name']); ?>
                   </option>  
                 <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="inputSchool">中学名称</label>
                <select class="form-control" id="schools">
                  <option value ="school">
                    选择高校
                   </option> 
                </select>
              </div>
              <button class="btn btn-primary"
                onclick="getXBContBySchool()">查询
              </button>
              <span id='briefXB'></span>
            </div>  
          </div>
          <div id="table-cont">
            <a href="./downloadXBExcel" class="download">下载</a>
            <div class="table-responsive">
              <table class="table table-bordered table-hover .table-condensed" id='showXB'>
              </table>
            </div>
            <nav>
              <ul class="pagination" id="pagination">
              </ul>
            </nav>
          </div>