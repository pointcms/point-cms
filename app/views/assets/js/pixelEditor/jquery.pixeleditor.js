(function ($, document, window) {
    'use strict';

    function PixelEditor(element, options) {
        this.elem = element;
        options = options || {};
        this.className = options.className || 'pixeleditor';

        // 'bold', 'italic', 'link', 'h2', 'h3', 'h4', 'alignleft', 'aligncenter', 'alignright', 'quote', 'code', 'list', 'x', 'source'
        var defaultButtons = ['bold', 'italic', 'link', 'list', 'h2', 'undo', 'source', 'more'];
        var additionalButtons = ['quote', 'code', 'underline', 'deleted', 'line']; // Add your additional buttons here
        this.buttons = options.buttons || defaultButtons;
        this.additional_buttons = options.additional_buttons || additionalButtons;
        this.buttonsHtml = options.buttonsHtml || null;
        this.overwriteButtonSettings = options.overwriteButtonSettings || null;
        this.css = options.css || null;
        this.onLoaded = typeof options.onLoaded === 'function' ? options.onLoaded : null;
        this.randomString = Math.random().toString(36).substring(7);

        this.attachEvents();
    }

    // initialize
    PixelEditor.prototype.attachEvents = function () {
        this.bootstrap();
        this.addToolbar();
        this.additionalToolbar();
        this.handleKeypress();
        this.utils();
        this.autoHeight(); // Add this line to call the autoHeight function.

        // Add an input event listener to update the status bar
        var _this = this;
        var $editor = $(_this.elem);

        // Add selection change handling
        this.handleSelectionChange();

        $editor.on('input', function () {
            _this.updateStatus();
        });

        // Update the status bar on page load
        _this.updateStatus();
        // Periodically update the status bar (e.g., every 1000 milliseconds or 1 second)
        setInterval(function () {
            _this.updateStatus();
        }, 1000);


        if (this.onLoaded !== null) {
            this.onLoaded.call(this);
        }
    };

    // destory editor
    PixelEditor.prototype.detachEvents = function () {
        var _this = this;
        var $container = $(_this.elem).closest('.' + _this.className + '-wrapper');
        var $toolbar = $container.find('.' + _this.className + '-toolbar');

        $toolbar.remove();
        $(_this.elem).removeClass(_this.className).removeAttr('contenteditable').unwrap();
    };

    // Adding necessary classes and attributes in editor
    PixelEditor.prototype.bootstrap = function () {
        var _this = this;
        var tag = $(_this.elem).prop('tagName').toLowerCase();

        if (tag === 'textarea' || tag === 'input') {
            var placeholderText = $(_this.elem).attr('placeholder') || '';

            var marginTop = $(_this.elem).css('marginTop') || 0;
            var marginBottom = $(_this.elem).css('marginBottom') || 0;
            var style = '';
            if (marginTop.length > 0 || marginBottom.length > 0) {
                style = ' style="margin-top: ' + marginTop + '; margin-bottom: ' + marginBottom + '" ';
            }

            $(_this.elem).after('<div id="' + _this.randomString + '-editor" placeholder="' + placeholderText + '">' + $(_this.elem).val() + '</div>');
            $(_this.elem).hide().addClass(_this.randomString + '-bind');

            _this.elem = document.getElementById(_this.randomString + '-editor');
            $(_this.elem).attr('contentEditable', true).addClass(_this.className).wrap('<div class="' + _this.className + '-wrapper"' + style + '></div>');
        } else {
            $(_this.elem).attr('contentEditable', true).addClass(_this.className).wrap('<div class="' + _this.className + '-wrapper"></div>');
        }

        this.$wrapperElem = $(_this.elem).parent();

        if (_this.css !== null) {
            $(_this.elem).css(_this.css);
        }

        this.containerClass = '.' + _this.className + '-wrapper';

        if (typeof _this.elem === 'string') {
            _this.elem = $(_this.elem).get(0);
        }

        // Add a status bar inside the wrapper
        this.$wrapperElem.append('<div class="' + this.className + '-statusbar">words: <span class="word-count">0</span> | chars: <span class="char-count">0</span></div>');

    };

    // enter and paste key handler
    PixelEditor.prototype.handleKeypress = function () {
        var _this = this;

        $(_this.elem).keydown(function (e) {
            if (e.keyCode === 13 && _this.isSelectionInsideElement('li') === false) {
                e.preventDefault();

                if (e.shiftKey === true) {
                    document.execCommand('insertHTML', false, '<br>');
                } else {
                    document.execCommand('insertHTML', false, '<br><br>');
                }

                return false;
            }
        });

        _this.elem.addEventListener('paste', function (e) {
            e.preventDefault();
            var text = e.clipboardData.getData('text/plain').replace(/\n/ig, '<br>');
            document.execCommand('insertHTML', false, text);
        });

    };

    PixelEditor.prototype.isSelectionInsideElement = function (tagName) {
        var sel, containerNode;
        tagName = tagName.toUpperCase();
        if (window.getSelection) {
            sel = window.getSelection();
            if (sel.rangeCount > 0) {
                containerNode = sel.getRangeAt(0).commonAncestorContainer;
            }
        } else if ((sel = document.selection) && sel.type != "Control") {
            containerNode = sel.createRange().parentElement();
        }
        while (containerNode) {
            if (containerNode.nodeType == 1 && containerNode.tagName == tagName) {
                return true;
            }
            containerNode = containerNode.parentNode;
        }
        return false;
    };

    // adding toolbar
    PixelEditor.prototype.addToolbar = function () {
        var _this = this;

        $(_this.elem).before('<div class="' + _this.className + '-toolbar"><ul></ul></div>');
        this.$toolbarContainer = this.$wrapperElem.find('.' + _this.className + '-toolbar');

        this.populateButtons();
    };

    // additional toolbar
    PixelEditor.prototype.additionalToolbar = function () {
        var _this = this;

        $(_this.elem).before('<div class="' + _this.className + '-additional-toolbar"><ul></ul></div>');
        this.$toolbarContainer = this.$wrapperElem.find('.' + _this.className + '-additional-toolbar');

        this.populateadditionalButtons(); // Populate buttons from additionalButtons array
    };

    // inejct button events
    PixelEditor.prototype.injectButton = function (settings) {
        var _this = this;

        // overwriting default button settings
        if (_this.overwriteButtonSettings !== null && _this.overwriteButtonSettings[settings.buttonIdentifier] !== undefined) {
            var newSettings = $.extend({}, settings, _this.overwriteButtonSettings[settings.buttonIdentifier]);
            settings = newSettings;
        }

        // if button html exists, overwrite default button html
        if (_this.buttonsHtml !== null && _this.buttonsHtml[settings.buttonIdentifier] !== undefined) {
            settings.buttonHtml = _this.buttonsHtml[settings.buttonIdentifier];
        }

        // adding button html with tooltip
        if (settings.buttonHtml) {
            if (settings.childOf !== undefined) {
                var $parentContainer = _this.$toolbarContainer.find('.toolbar-' + settings.childOf).parent('li');

                if ($parentContainer.find('ul').length === 0) {
                    $parentContainer.append('<ul></ul>');
                }

                $parentContainer = $parentContainer.find('ul');
                $parentContainer.append('<li><button type="button" class="button-toolbar toolbar-' + settings.buttonIdentifier + '" data-title="' + settings.buttonTitle + '">' + settings.buttonHtml + '</button></li>');
            } else {
                _this.$toolbarContainer.children('ul').append('<li><button type="button" class="button-toolbar toolbar-' + settings.buttonIdentifier + '" data-title="' + settings.buttonTitle + '">' + settings.buttonHtml + '</button></li>');
            }
        }

        // bind click event
        if (typeof settings.clickHandler === 'function') {
            $('html').find(_this.elem).closest(_this.containerClass).on('click', '.toolbar-' + settings.buttonIdentifier, function (event) {
                if (typeof settings.hasChild !== undefined && settings.hasChild === true) {
                    event.stopPropagation();
                } else {
                    event.preventDefault();
                }

                // Toggle the "active" class
                $(this).toggleClass('active');

                settings.clickHandler.call(this, this);
                $(_this.elem).trigger('keyup');
            });

            // Initialize button state based on current formatting
            _this.updateButtonStates();
        }
    };


    // bidning all buttons
    PixelEditor.prototype.populateButtons = function () {
        var _this = this;

        $.each(_this.buttons, function (index, button) {
            if (typeof _this[button] === 'function') {
                _this[button]();
            }
        });

    };

    // get selection
    PixelEditor.prototype.getSelection = function () {
        if (window.getSelection) {
            var selection = window.getSelection();

            if (selection.rangeCount) {
                return selection;
            }
        }

        return false;
    };


    PixelEditor.prototype.populateadditionalButtons = function () {
        var _this = this;

        $.each(_this.additional_buttons, function (index, button) {
            if (typeof _this[button] === 'function') {
                _this[button]();
            }
        });

    };

    // get selection
    PixelEditor.prototype.getSelection = function () {
        if (window.getSelection) {
            var selection = window.getSelection();

            if (selection.rangeCount) {
                return selection;
            }
        }

        return false;
    };

    // remove formatting
    PixelEditor.prototype.removeFormatting = function (arg) {
        var _this = this;
        var inFullArea = arg.inFullArea;

        if (_this.isSelectionOutsideOfEditor() === true) {
            return false;
        }

        if (inFullArea === false) {
            var selection = _this.getSelection();
            var selectedText = selection.toString();

            if (selection && selectedText.length > 0) {

                var range = selection.getRangeAt(0);
                var $parent = $(range.commonAncestorContainer.parentNode);

                if ($parent.attr('class') === _this.className || $parent.attr('class') === _this.className + '-wrapper') {
                    var node = document.createElement('span');
                    $(node).attr('data-value', 'temp').html(selectedText.replace(/\n/ig, '<br>'));
                    range.deleteContents();
                    range.insertNode(node);

                    $('[data-value="temp"]').contents().unwrap();
                } else {

                    var topMostParent;
                    var hasParentNode = false;
                    $.each($parent.parentsUntil(_this.elem), function (index, el) {
                        topMostParent = el;
                        hasParentNode = true;
                    });

                    if (hasParentNode === true) {
                        $(topMostParent).html($(topMostParent).text().replace(/\n/ig, '<br>')).contents().unwrap();
                    } else {
                        $parent.contents().unwrap();
                    }

                }

            }
        } else {
            $(_this.elem).html($(_this.elem).text().replace(/\n/ig, '<br>'));
        }

        // _this.removeEmptyTags();
    };

    // removing empty tags
    PixelEditor.prototype.removeEmptyTags = function () {
        var _this = this;
        $(_this.elem).html($(_this.elem).html().replace(/(<(?!\/)[^>]+>)+(<\/[^>]+>)+/, ''));
    };

    // remove block elemenet from selection
    PixelEditor.prototype.removeBlockElementFromSelection = function (selection, removeBr) {
        var _this = this;
        var result;

        removeBr = removeBr === undefined ? false : removeBr;
        var removeBrNode = '';
        if (removeBr === true) {
            removeBrNode = ', br';
        }

        var range = selection.getRangeAt(0);
        var selectedHtml = range.cloneContents();
        var temp = document.createElement('temp');
        $(temp).html(selectedHtml);
        $(temp).find('h2, p, div' + removeBrNode).each(function () {
            $(this).replaceWith(this.childNodes);
        });
        result = $(temp).html();

        return result;
    };

    // wrap selction with a tag
    PixelEditor.prototype.wrapSelectionWithNodeName = function (arg) {
        var _this = this;
        if (_this.isSelectionOutsideOfEditor() === true) {
            return false;
        }

        var node = {
            name: 'span',
            blockElement: false,
            style: null,
            class: null,
            attribute: null,
            keepHtml: false
        };

        if (typeof arg === 'string') {
            node.name = arg;
        } else {
            node.name = arg.nodeName || node.name;
            node.blockElement = arg.blockElement || node.blockElement;
            node.style = arg.style || node.style;
            node.class = arg.class || node.class;
            node.attribute = arg.attribute || node.attribute;
            node.keepHtml = arg.keepHtml || node.keepHtml;
        }

        var selection = _this.getSelection();

        if (selection && selection.toString().length > 0 && selection.rangeCount) {
            // checking if already wrapped
            var isWrapped = _this.isAlreadyWrapped(selection, node);

            // wrap node
            var range = selection.getRangeAt(0).cloneRange();
            var tag = document.createElement(node.name);

            // adding necessary attribute to tag
            if (node.style !== null || node.class !== null || node.attribute !== null) {
                tag = _this.addAttribute(tag, node);
            }

            // if selection contains html, surround contents has some problem with pre html tag and raw text selection
            if (_this.selectionContainsHtml(range)) {
                range = selection.getRangeAt(0);

                if (node.keepHtml === true) {
                    var clonedSelection = range.cloneContents();
                    var div = document.createElement('div');
                    div.appendChild(clonedSelection);
                    $(tag).html(div.innerHTML);
                } else {
                    tag.textContent = selection.toString();
                }

                range.deleteContents();
                range.insertNode(tag);

                if (range.commonAncestorContainer.localName === node.name) {
                    $(range.commonAncestorContainer).contents().unwrap();
                    _this.removeEmptyTags();
                }
            } else {
                range.surroundContents(tag);
                selection.removeAllRanges();
                selection.addRange(range);
            }

            if (isWrapped === true) {
                _this.removeWrappedDuplicateTag(tag);
            }

            _this.removeEmptyTags();
            selection.removeAllRanges();
        }
    };

    // wrap selection with unordered list
    PixelEditor.prototype.wrapSelectionWithList = function (tagname) {
        var _this = this;
        tagname = tagname || 'ul';

        // preventing outside selection
        if (_this.isSelectionOutsideOfEditor() === true) {
            return false;
        }

        // if text selected
        var selection = _this.getSelection();
        if (selection && selection.toString().length > 0 && selection.rangeCount) {
            var selectedHtml = _this.removeBlockElementFromSelection(selection, true);
            var listArray = selectedHtml.split('\n').filter(function (v) {
                return v !== '';
            });
            var wrappedListHtml = $.map(listArray, function (item) {
                return '<li>' + $.trim(item) + '</li>';
            });

            var node = document.createElement(tagname);
            $(node).html(wrappedListHtml);

            var range = selection.getRangeAt(0);
            range.deleteContents();
            range.insertNode(node);

            selection.removeAllRanges();
        }

    };

    // if selection contains html tag, surround content fails if selection contains html
    PixelEditor.prototype.selectionContainsHtml = function (range) {
        var _this = this;
        if (range.startContainer.parentNode.className === _this.className + '-wrapper') return false;
        else return true;
    };

    // if already wrapped with same tag
    PixelEditor.prototype.isAlreadyWrapped = function (selection, node) {
        var _this = this;
        var range = selection.getRangeAt(0);
        var el = $(range.commonAncestorContainer);
        var result = false;

        if (el.parent().prop('tagName').toLowerCase() === node.name && el.parent().hasClass(_this.className) === false) {
            result = true;
        } else if (node.blockElement === true) {
            $.each(el.parentsUntil(_this.elem), function (index, el) {
                var tag = el.tagName.toLowerCase();
                if ($.inArray(tag, ['h1', 'h2', 'h3', 'h4', 'h5', 'h6']) !== -1) {
                    result = true;
                }
            });
        } else {
            $.each(el.parentsUntil(_this.elem), function (index, el) {
                var tag = el.tagName.toLowerCase();
                if (tag === node.name) {
                    result = true;
                }
            });
        }

        return result;
    };

    // remove wrap if already wrapped with same tag
    PixelEditor.prototype.removeWrappedDuplicateTag = function (tag) {
        var _this = this;
        var tagName = tag.tagName;

        $(tag).unwrap();

        if ($(tag).prop('tagName') === tagName && $(tag).parent().hasClass(_this.className) === false && $(tag).parent().hasClass(_this.className + '-wrapper')) {
            $(tag).unwrap();
        }
    };

    // adding attribute in tag
    PixelEditor.prototype.addAttribute = function (tag, node) {
        if (node.style !== null) {
            $(tag).attr('style', node.style);
        }

        if (node.class !== null) {
            $(tag).addClass(node.class);
        }

        if (node.attribute !== null) {
            if ($.isArray(node.attribute) === true) {
                if ($.isArray(node.attribute[0]) !== true) {
                    node.attribute[0] = [node.attribute[0], node.attribute[1]];
                }
                $.each(node.attribute, function (index, pair) {
                    $(tag).attr(pair[0], pair[1]);
                });
            } else {
                $(tag).attr(node.attribute);
            }
        }

        return tag;
    };

    // insert a node into cursor point in editor
    PixelEditor.prototype.insertAtCaret = function (node) {
        var _this = this;
        if (_this.isSelectionOutsideOfEditor() === true) {
            return false;
        }

        if (_this.getSelection()) {
            var range = _this.getSelection().getRangeAt(0);
            range.insertNode(node);
        } else {
            $(node).appendTo(_this.elem);
        }
    };

    // checking if selection outside of editor or not
    PixelEditor.prototype.isSelectionOutsideOfEditor = function () {
        return !this.elementContainsSelection(this.elem);
    };

    // node contains in containers or not
    PixelEditor.prototype.isOrContains = function (node, container) {
        while (node) {
            if (node === container) {
                return true;
            }
            node = node.parentNode;
        }
        return false;
    };

    // selected text is inside container
    PixelEditor.prototype.elementContainsSelection = function (el) {
        var _this = this;
        var sel;
        if (window.getSelection) {
            sel = window.getSelection();
            if (sel.rangeCount > 0) {
                for (var i = 0; i < sel.rangeCount; ++i) {
                    if (!_this.isOrContains(sel.getRangeAt(i).commonAncestorContainer, el)) {
                        return false;
                    }
                }
                return true;
            }
        } else if ((sel = document.selection) && sel.type !== "Control") {
            return _this.isOrContains(sel.createRange().parentElement(), el);
        }
        return false;
    };

    // insert html chunk into editor's temp tag
    PixelEditor.prototype.insertHtml = function (html) {
        var _this = this;
        $(_this.elem).find('temp').html(html);
    };

    // utility of editor
    PixelEditor.prototype.utils = function () {
        var _this = this;

        // binding value in textarea if present
        if ($('.' + _this.randomString + '-bind').length > 0) {
            var bindData;
            $('html').on('click keyup', _this.elem, function () {
                var el = _this.elem;
                clearTimeout(bindData);
                bindData = setTimeout(function () {
                    $('.' + _this.randomString + '-bind').html($(el).html());
                }, 250);
            });
        }

        $(document).click(function (event) {
            $('.' + _this.className).closest('.' + _this.className + '-wrapper').find('.' + _this.className + '-toolbar > ul > li > ul').hide();
        });
    };

    // Get value of current easy editor
    PixelEditor.prototype.getValue = function () {
        var _this = this;

        var html = $(_this.elem).html();
        var plainText = $(_this.elem).text();
        var characterCount = plainText.length;
        var wordCount = plainText.trim().split(/\s+/).length;

        return {
            html: html,
            plainText: plainText,
            characterCount: characterCount,
            wordCount: wordCount
        };
    };

    PixelEditor.prototype.bold = function () {
        var _this = this;
        var settings = {
            buttonIdentifier: 'bold',
            buttonTitle: 'Bold',
            buttonHtml: '<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="pixels-icon">\n' +
                '        <path\n' +
                '         d="M8 11h4.5a2.5 2.5 0 0 0 0-5H8v5Zm10 4.5a4.501 4.501 0 0 1-4.5 4.5H6V4h6.5a4.5 4.5 0 0 1 3.256 7.606A4.5 4.5 0 0 1 18 15.5ZM8 13v5h5.5a2.5 2.5 0 0 0 0-5H8Z"></path>\n' +
                '        </svg>',
            clickHandler: function () {
                _this.wrapSelectionWithNodeName({nodeName: 'strong', keepHtml: true});
            }
        };

        _this.injectButton(settings);
    };

    PixelEditor.prototype.italic = function () {
        var _this = this;
        var settings = {
            buttonIdentifier: 'italic',
            buttonTitle: 'Italic',
            buttonHtml: '<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="pixels-icon">\n' +
                '                <path d="M15 20H7v-2h2.927l2.116-12H9V4h8v2h-2.927l-2.116 12H15v2Z"></path>\n' +
                '            </svg>',
            clickHandler: function () {
                _this.wrapSelectionWithNodeName({nodeName: 'em', keepHtml: true});
            }
        };

        _this.injectButton(settings);
    };

    PixelEditor.prototype.h2 = function () {
        var _this = this;
        var settings = {
            buttonIdentifier: 'header-2',
            buttonTitle: 'Heading',
            buttonHtml: '<svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="pixels-icon"><path d="M17 11V4h2v17h-2v-8H7v8H5V4h2v7z"></path></svg>',
            clickHandler: function () {
                _this.wrapSelectionWithNodeName({nodeName: 'h2', blockElement: true});
            }
        };

        _this.injectButton(settings);
    };

    PixelEditor.prototype.undo = function () {
        var _this = this;
        var settings = {
            buttonIdentifier: 'remove-formatting',
            buttonTitle: 'Undo',
            buttonHtml: '<svg height="24" width="24" viewBox="0 0 36 36"  preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" class="pixels-icon"><title>undo-line</title><path d="M20.87,11.14h-13l5.56-5.49A1,1,0,0,0,12,4.22L4,12.13,12,20a1,1,0,0,0,1.41-1.42L7.86,13.14h13a9.08,9.08,0,0,1,9.13,9,9,9,0,0,1-5,8A1,1,0,0,0,25.93,32a11,11,0,0,0-5.06-20.82Z" class="clr-i-outline clr-i-outline-path-1" stroke="#000000" stroke-width="1"></path><rect x="0" y="0" width="24" height="24" fill-opacity="0"/></svg>',
    clickHandler: function () {
    _this.removeFormatting({inFullArea: false});
    }
    };

    _this.injectButton(settings);
    };


    PixelEditor.prototype.link = function () {
    var _this = this;
    var settings = {
    buttonIdentifier: 'link',
    buttonTitle: 'Link',
    buttonHtml: '<svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="pixels-icon">\n' +
    '                <path\n' +
    '                    d="M18.364 15.536 16.95 14.12l1.414-1.414a5.001 5.001 0 0 0-3.531-8.551 5 5 0 0 0-3.54 1.48L9.879 7.05 8.464 5.636 9.88 4.222a7 7 0 1 1 9.9 9.9l-1.415 1.414zm-2.828 2.828-1.415 1.414a7 7 0 0 1-9.9-9.9l1.415-1.414L7.05 9.88l-1.414 1.414a5 5 0 1 0 7.071 7.071l1.414-1.414 1.415 1.414zm-.708-10.607 1.415 1.415-7.071 7.07-1.415-1.414 7.071-7.07z"></path>\n' +
    '            </svg>',
    clickHandler: function () {
    _this.wrapSelectionWithNodeName({nodeName: 'a', attribute: ['href', prompt('Insert link', '')]});
    }
    };

    _this.injectButton(settings);
    };

    PixelEditor.prototype.list = function () {
    var _this = this;
    var settings = {
    buttonIdentifier: 'list',
    buttonTitle: 'List',
    buttonHtml: '<svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="pixels-icon"><path d="M8 4h13v2H8zM4.5 6.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 7a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 6.9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM8 11h13v2H8zm0 7h13v2H8z"></path></svg>',
    clickHandler: function () {
    _this.wrapSelectionWithList();
    }
    };

    _this.injectButton(settings);
    };

    PixelEditor.prototype.source = function () {
    var _this = this;
    var settings = {
    buttonIdentifier: 'source',
    buttonTitle: 'View Source',
    buttonHtml: '<svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="pixels-icon"><path d="m23 12-7.071 7.071-1.414-1.414L20.172 12l-5.657-5.657 1.414-1.414zM3.828 12l5.657 5.657-1.414 1.414L1 12l7.071-7.071 1.414 1.414z"></path></svg>',
    clickHandler: function (thisButton) {
    var $elemContainer = $(thisButton).closest('.' + _this.className + '-wrapper');
    var $elem = $elemContainer.find('.' + _this.className);
    var $tempTextarea;

    if ($(thisButton).hasClass('is-view-source-mode')) {
    $tempTextarea = $('body > textarea.' + _this.className + '-temp');
    $elem.css('visibility', 'visible');
    $tempTextarea.remove();
    $(thisButton).removeClass('is-view-source-mode');
    } else {
    $('body').append('<textarea class="' + _this.className + '-temp" style="position: absolute; margin: 0;"></textarea>');
    $tempTextarea = $('body > textarea.' + _this.className + '-temp');

    $tempTextarea.css({
    'top': $elem.offset().top,
    'left': $elem.offset().left,
    'width': $elem.outerWidth(),
    'height': $elem.outerHeight()
    }).html($elem.html());

    $elem.css('visibility', 'hidden');
    $(thisButton).addClass('is-view-source-mode');

    $tempTextarea.on('keyup click change keypress', function () {
    $elem.html($(this).val());
    });
        // Toggle the visibility of the additional toolbar
        _this.toggleAdditionalToolbar();
    }
    }
    };

    _this.injectButton(settings);
    };

    PixelEditor.prototype.more = function () {
    var _this = this;
    var settings = {
    buttonIdentifier: 'more',
    buttonTitle: 'More',
    buttonHtml: '<svg aria-hidden="true" focusable="false" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="pixels-icon c-btn__icon"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 17a2 2 0 1 1 0 4 2 2 0 0 1 0-4Zm0-7a2 2 0 1 1 0 4 2 2 0 0 1 0-4Zm2-5a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z"></path></svg>',
    clickHandler: function () {
    // Toggle the visibility of the additional toolbar
        _this.toggleAdditionalToolbar();
    }
    };

    _this.injectButton(settings);
    };

    // Function to toggle the visibility of the additional toolbar
    PixelEditor.prototype.toggleAdditionalToolbar = function () {
    this.$toolbarContainer.toggle();
    };

    PixelEditor.prototype.quote = function () {
    var _this = this;
    var settings = {
    buttonIdentifier: 'quote',
    buttonTitle: 'Quote',
    buttonHtml: '<svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="pixels-icon"><path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5 3.871 3.871 0 0 1-2.748-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5 3.871 3.871 0 0 1-2.748-1.179z"></path></svg>',
    clickHandler: function () {
    _this.wrapSelectionWithNodeName({nodeName: 'blockquote'});
    _this.toggleAdditionalToolbar();

    }
    };

    _this.injectButton(settings);
    };

    PixelEditor.prototype.code = function () {
    var _this = this;
    var settings = {
    buttonIdentifier: 'code',
    buttonTitle: 'Code',
    buttonHtml: '<svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="pixels-icon"><path d="M3 3h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm1 2v14h16V5zm15 7-3.536 3.536-1.414-1.415L16.172 12 14.05 9.879l1.414-1.415zM7.828 12l2.122 2.121-1.414 1.415L5 12l3.536-3.536L9.95 9.88z"></path></svg>',
    clickHandler: function () {
    _this.wrapSelectionWithNodeName({nodeName: 'pre'});
    // Toggle the visibility of the additional toolbar
    _this.toggleAdditionalToolbar();
    }
    };

    _this.injectButton(settings);
    };

    PixelEditor.prototype.underline = function () {
    var _this = this;
    var settings = {
    buttonIdentifier: 'underline',
    buttonTitle: 'Underline',
    buttonHtml: '<svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="pixels-icon"><path d="M8 3v9a4 4 0 1 0 8 0V3h2v9a6 6 0 1 1-12 0V3zM4 20h16v2H4z"></path></svg>',
    clickHandler: function () {
    _this.wrapSelectionWithNodeName({nodeName: 'u', keepHtml: true});
    // Toggle the visibility of the additional toolbar
    _this.toggleAdditionalToolbar();
    }
    };

    _this.injectButton(settings);
    };

    PixelEditor.prototype.deleted = function () {
    var _this = this;
    var settings = {
    buttonIdentifier: 'deleted',
    buttonTitle: 'Deleted',
    buttonHtml: '<svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="pixels-icon"><path d="M17.154 14c.23.516.346 1.09.346 1.72 0 1.342-.524 2.392-1.571 3.147C14.88 19.622 13.433 20 11.586 20c-1.64 0-3.263-.381-4.87-1.144V16.6c1.52.877 3.075 1.316 4.666 1.316 2.551 0 3.83-.732 3.839-2.197a2.21 2.21 0 0 0-.648-1.603l-.12-.117H3v-2h18v2h-3.846zm-4.078-3H7.629a4.087 4.087 0 0 1-.481-.522C6.716 9.92 6.5 9.246 6.5 8.452c0-1.236.466-2.287 1.397-3.153C8.83 4.433 10.271 4 12.222 4c1.471 0 2.879.328 4.222.984v2.152c-1.2-.687-2.515-1.03-3.946-1.03-2.48 0-3.719.782-3.719 2.346 0 .42.218.786.654 1.099s.974.562 1.613.75c.62.18 1.297.414 2.03.699z"></path></svg>',
    clickHandler: function () {
    _this.wrapSelectionWithNodeName({nodeName: 'del', keepHtml: true});
    // Toggle the visibility of the additional toolbar
    _this.toggleAdditionalToolbar();
    }
    };

    _this.injectButton(settings);
    };

    PixelEditor.prototype.line = function () {
    var _this = this;
    var settings = {
    buttonIdentifier: 'line',
    buttonTitle: 'Line divider',
    buttonHtml: '<svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="pixels-icon"><path d="M2 11h6v2H2z"></path><path d="M2 11h6v2H2zm7 0h6v2H9zm7 0h6v2h-6z"></path><path d="M12 6.586 9.707 4.293 8.293 5.707 12 9.414l3.707-3.707-1.414-1.414zm0 10.828-2.293 2.293-1.414-1.414L12 14.586l3.707 3.707-1.414 1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>',
    clickHandler: function () {
    const hr = document.createElement('hr');
    document.execCommand('insertHTML', false, hr.outerHTML);
    // Toggle the visibility of the additional toolbar
    _this.toggleAdditionalToolbar();
    }
    };

    _this.injectButton(settings);
    };

    // Add this function for auto height adjustment
    PixelEditor.prototype.autoHeight = function() {
    var _this = this;
    var $elem = $(_this.elem);

    $elem.on('input', function() {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
    });
    };

    PixelEditor.prototype.updateStatus = function() {
    var _this = this;
    var $editor = $(_this.elem);
    var $wordCount = _this.$wrapperElem.find('.word-count');
    var $charCount = _this.$wrapperElem.find('.char-count');

    // Get the text content and strip HTML tags
    var text = $editor.text().replace(/<\/?[^>]+(>|$)/g, '');

    // Split the text into words
    var words = text.trim().split(/\s+/).filter(function(word) {
    return word.length > 0;
    });

    var charCount = text.length;

    // Update the counters
    $wordCount.text(words.length);
    $charCount.text(charCount);
    };

    // Add this function to check selection formatting and update button states
    PixelEditor.prototype.updateButtonStates = function () {
    var _this = this;
    var buttonsToCheck = ['bold', 'italic', 'link', 'list', 'h2', 'x', 'source', 'more','quote', 'code', 'underline', 'deleted', 'line']; // Add more formatting options here

    buttonsToCheck.forEach(function (button) {
    var isActive = document.queryCommandState(button);
    var $button = _this.$toolbarContainer.find('.toolbar-' + button);
    if (isActive) {
    $button.addClass('active');
    } else {
    $button.removeClass('active');
    }
    });
    };

    // Attach a selection change listener to the editor
    PixelEditor.prototype.handleSelectionChange = function () {
    var _this = this;

    $(_this.elem).on('mouseup keyup', function () {
    _this.updateButtonStates();
    });
    };


    window.PixelEditor = PixelEditor;

    $.fn.pixelEditor = function (options) {
    return this.each(function () {
    if (!$.data(this, 'plugin_pixelEditor')) {
    $.data(this, 'plugin_pixelEditor',
    new PixelEditor(this, options));
    }
    });
    };

    })(jQuery, document, window);
