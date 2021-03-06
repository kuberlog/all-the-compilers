// Licensed to the .NET Foundation under one or more agreements.
// The .NET Foundation licenses this file to you under the MIT license.
// See the LICENSE file in the project root for more information.

using System;
using System.Diagnostics;
using Microsoft.CodeAnalysis.Editor.Shared.Utilities;
using Microsoft.CodeAnalysis.Editor.Tagging;
using Microsoft.VisualStudio.Text;
using Microsoft.VisualStudio.Text.Editor;

namespace Microsoft.CodeAnalysis.Editor.Shared.Tagging
{
    internal partial class TaggerEventSources
    {
        private class ViewSpanChangedEventSource : ITaggerEventSource
        {
            private readonly ForegroundThreadAffinitizedObject _foregroundObject;

            private readonly ITextView _textView;

            private Span? _span;

            public event EventHandler<TaggerEventArgs>? Changed;

            public ViewSpanChangedEventSource(IThreadingContext threadingContext, ITextView textView)
            {
                Debug.Assert(textView != null);
                _foregroundObject = new ForegroundThreadAffinitizedObject(threadingContext);
                _textView = textView;
            }

            public void Connect()
            {
                _foregroundObject.AssertIsForeground();
                _textView.LayoutChanged += OnLayoutChanged;
            }

            public void Disconnect()
            {
                _foregroundObject.AssertIsForeground();
                _textView.LayoutChanged -= OnLayoutChanged;
            }

            private void OnLayoutChanged(object? sender, TextViewLayoutChangedEventArgs e)
            {
                _foregroundObject.AssertIsForeground();
                // The formatted span refers to the span of the textview's buffer that is visible.
                // If it changes, then we want to reclassify.  Note: the span might not change if
                // text were overwritten.  However, in the case of text-edits, we'll hear about 
                // through other means as we have an EventSource for that purpose.  This event
                // source is for knowing if the user moves the view around.  This handles direct
                // moves using the caret/scrollbar, as well as moves that happen because someone
                // jumped directly to a location using goto-def.  It also handles view changes
                // caused by the user collapsing an outlining region.

                var lastSpan = _span;
                _span = _textView.TextViewLines.FormattedSpan.Span;

                if (_span != lastSpan)
                {
                    // The span changed.  This could have happened for a few different reasons.  
                    // If none of the view's text snapshots changed, then it was because of scrolling.
                    RaiseChanged();
                }
            }

            private void RaiseChanged()
                => this.Changed?.Invoke(this, new TaggerEventArgs());
        }
    }
}
