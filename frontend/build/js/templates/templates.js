define(['handlebars'], function(Handlebars) {

this["Templates"] = this["Templates"] || {};

this["Templates"]["control/templates/controlViewTemplate.html"] = Handlebars.template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "<div class=\"row\">\n  <div class=\"col-xs-4 col-sm-offset-2\">\n    <div class=\"btn-group\">\n      <button type=\"button\" class=\"btn btn-default play\">Play</button>\n      <button type=\"button\" class=\"btn btn-default stop\">stop</button>\n    </div>\n  </div>\n  <div class=\"progress col-xs-2 col-sm-offset-1\">\n    <div class=\"progress-bar\"></div>\n  </div>\n</div>";
  });

this["Templates"]["control/templates/layoutTemplate.html"] = Handlebars.template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "<div class=\"main\"></div>\n";
  });

this["Templates"]["message/templates/messageTemplate.html"] = Handlebars.template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  var buffer = "";


  return buffer;
  });

this["Templates"]["message/templates/registerTemplate.html"] = Handlebars.template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "<div class=\"alert alert-success messages text-center\" >\n  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>\n  <span><strong>Thanks for registering</strong> We just unlocked 2 videos. </span>\n  <a class=\"btn btn-mini btn-primary unlock\" href=\"#\">Unlock more!</a>\n</div>\n";
  });

this["Templates"]["playlist/templates/layoutTemplate.html"] = Handlebars.template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "<div class=\"main\"></div>";
  });

this["Templates"]["playlist/templates/tableHeadTemplate.html"] = Handlebars.template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "<thead>\n	<tr>\n		<th>Artist</th>\n		<th>Album</th>\n		<th>Track</th>\n	</tr>\n</thead>";
  });

this["Templates"]["playlist/templates/trackTemplate.html"] = Handlebars.template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  var buffer = "", stack1, stack2, functionType="function", escapeExpression=this.escapeExpression;


  buffer += "<td>"
    + escapeExpression(((stack1 = ((stack1 = depth0.artist),stack1 == null || stack1 === false ? stack1 : stack1.name)),typeof stack1 === functionType ? stack1.apply(depth0) : stack1))
    + "</td>\n<td>"
    + escapeExpression(((stack1 = ((stack1 = depth0.album),stack1 == null || stack1 === false ? stack1 : stack1.name)),typeof stack1 === functionType ? stack1.apply(depth0) : stack1))
    + "</td>\n<td>";
  if (stack2 = helpers.name) { stack2 = stack2.call(depth0, {hash:{},data:data}); }
  else { stack2 = depth0.name; stack2 = typeof stack2 === functionType ? stack2.apply(depth0) : stack2; }
  buffer += escapeExpression(stack2)
    + "</td>";
  return buffer;
  });

this["Templates"]["videoPlayer/templates/layoutTemplate.html"] = Handlebars.template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "    <div class=\"player\"></div>\n";
  });

this["Templates"]["videoPlayer/templates/videoPlayerTemplate.html"] = Handlebars.template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "<div id=\"video\">\n</div>";
  });

return this["Templates"];

});